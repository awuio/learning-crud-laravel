<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanDeletedProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'garbage:clean-products {--days=30 : The number of days before a soft-deleted product is permanently deleted}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permanently delete soft-deleted products and their images to save disk space.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        $dateLimit = now()->subDays($days);

        $this->info("Scanning for products deleted before {$dateLimit->toDateTimeString()}...");

        $products = Product::onlyTrashed()
            ->where('deleted_at', '<=', $dateLimit)
            ->get();

        $count = 0;

        foreach ($products as $product) {
            // Delete image from storage
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Permanently remove from database
            $product->forceDelete();
            $count++;
        }

        $this->info("Garbage collection completed. {$count} old products permanently removed.");
    }
}
