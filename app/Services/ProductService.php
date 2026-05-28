<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    /**
     * Store a new product and its uploaded image.
     *
     * @throws \Exception
     */
    public function createProduct(array $data, ?UploadedFile $image): Product
    {
        $uploadedImage = null;

        try {
            DB::beginTransaction();

            if ($image) {
                // Store the uploaded image first
                $uploadedImage = $image->store('products', 'public');
                $data['image'] = $uploadedImage;
            }

            $product = Product::create($data);

            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();

            // Clean up the uploaded image from disk storage if database record creation fails
            if ($uploadedImage) {
                Storage::disk('public')->delete($uploadedImage);
            }

            throw $e;
        }
    }

    /**
     * Update an existing product and its uploaded image.
     *
     * @throws \Exception
     */
    public function updateProduct(Product $product, array $data, ?UploadedFile $image): Product
    {
        $oldImage = $product->image;
        $newImageUploaded = null;

        try {
            DB::beginTransaction();

            if ($image) {
                // Upload new image first, but do not delete old one yet (database integrity)
                $newImageUploaded = $image->store('products', 'public');
                $data['image'] = $newImageUploaded;
            } else {
                // Prevent over-writing old image with null when no new image is uploaded
                unset($data['image']);
            }

            // Update database record
            $product->update($data);

            DB::commit();

            // If database update succeeds, delete old image to free disk space
            if ($newImageUploaded && $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();

            // Clean up the new uploaded image from disk storage if database update fails
            if ($newImageUploaded) {
                Storage::disk('public')->delete($newImageUploaded);
            }

            throw $e;
        }
    }
}
