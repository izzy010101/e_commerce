<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Facades\Log;

class DownloadClothingImages extends Command
{
    protected $signature = 'download:unsplash {count=25}';
    protected $description = 'Download images from Unsplash';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $productNames = ['shirt', 't-shirt', 'pants', 'dress', 'top', 'skirt', 'shorts', 'onesie'];
        $count = $this->argument('count');
        $client = new Client();
        $accessKey = 'p0NkNFcebWmk03890WUWQ1e_wa-wCmLWnPyOF3f8IkI';

        if (!$accessKey) {
            Log::error('Unsplash access key is not set.');
            return;
        }

        foreach ($productNames as $name) {
            $existingImages = Image::where('path', 'LIKE', '%unsplash_' . str_replace(' ', '_', $name) . '_%')->count();
            Log::info("Existing images count for {$name}: {$existingImages}");

            if ($existingImages >= $count) {
                Log::info("Images for {$name} already exist. Skipping download.");
                continue;
            }

            try {
                $response = $client->get("https://api.unsplash.com/search/photos", [
                    'query' => [
                        'query' => $name,
                        'per_page' => $count,
                        'client_id' => $accessKey,
                    ],
                ]);

                $photos = json_decode($response->getBody(), true)['results'];
                Log::info('API Response', ['photos' => $photos]);

                foreach ($photos as $index => $photo) {
                    $url = $photo['urls']['regular'];
                    $imageData = $client->get($url)->getBody();
                    $fileName = 'unsplash_' . str_replace(' ', '_', $name) . '_' . $index . '.jpg';
                    $filePath = 'storage/' . $fileName;

                    // Log the URL and file paths
                    Log::info('Image URL and path', ['url' => $url, 'filePath' => $filePath]);

                    Storage::disk('public_assets')->put($fileName, $imageData);

                    $products = Product::where('name', 'LIKE', '%' . ucfirst($name) . '%')->get();

                    if ($products->isEmpty()) {
                        Log::warning("No products found for name: $name");
                        continue;
                    }

                    foreach ($products as $product) {
                        Image::create([
                            'product_id' => $product->id,
                            'path' => $filePath,
                        ]);

                        Log::info('Image created', ['product_id' => $product->id, 'path' => $filePath]);
                    }

                    Log::info("Downloaded and stored: {$fileName}");
                }
            } catch (\Exception $e) {
                Log::error("Failed to download images for name {$name}: " . $e->getMessage());
            }
        }

        Log::info("Completed image download.");
    }

}


