<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['is_admin' => true]);
    $this->user = User::factory()->create(['is_admin' => false]);
    Storage::fake('public'); // Mock the public disk
});

test('admin can view products index', function () {
    Product::factory()->count(3)->create();

    $response = $this->actingAs($this->admin)->get(route('products.index'));

    $response->assertStatus(200);
    $response->assertViewHas('products');
});

test('admin can create a new product with image', function () {
    $category = Category::factory()->create();
    $image = UploadedFile::fake()->image('product.jpg');

    $response = $this->actingAs($this->admin)->post(route('products.store'), [
        'name' => 'Test Product',
        'description' => 'Test Description',
        'price' => 1500,
        'quantity' => 10,
        'category_id' => $category->id,
        'image' => $image,
    ]);

    $response->assertRedirect(route('products.index'));

    $product = Product::where('name', 'Test Product')->first();
    expect($product)->not->toBeNull();

    Storage::disk('public')->assertExists($product->getRawOriginal('image'));
});

test('product creation fails when required fields are missing', function () {
    $response = $this->actingAs($this->admin)->post(route('products.store'), [
        'name' => '', // Missing name
        'price' => 'not-a-number', // Invalid price
    ]);

    $response->assertSessionHasErrors(['name', 'price', 'category_id']);
});

test('admin can update a product and replace its image', function () {
    $product = Product::factory()->create([
        'image' => 'products/old_image.jpg',
    ]);

    // Simulate old image exists
    Storage::disk('public')->put('products/old_image.jpg', 'fake content');

    $newImage = UploadedFile::fake()->image('new_product.jpg');

    $response = $this->actingAs($this->admin)->put(route('products.update', $product), [
        'name' => 'Updated Product Name',
        'description' => $product->description,
        'price' => $product->price,
        'quantity' => $product->quantity,
        'category_id' => $product->category_id,
        'image' => $newImage,
    ]);

    $response->assertRedirect(route('products.index'));

    $product->refresh();
    expect($product->name)->toBe('Updated Product Name');

    // Verify new image is stored and old is deleted
    Storage::disk('public')->assertExists($product->getRawOriginal('image'));
    Storage::disk('public')->assertMissing('products/old_image.jpg');
});

test('admin can soft delete a product without deleting its image immediately', function () {
    $product = Product::factory()->create([
        'image' => 'products/to_be_soft_deleted.jpg',
    ]);
    Storage::disk('public')->put('products/to_be_soft_deleted.jpg', 'fake content');

    $response = $this->actingAs($this->admin)->delete(route('products.destroy', $product));

    $response->assertRedirect(route('products.index'));

    // Model should be soft deleted
    $this->assertSoftDeleted($product);

    // Image MUST STILL EXIST (Garbage Collection handles physical deletion later)
    Storage::disk('public')->assertExists('products/to_be_soft_deleted.jpg');
});
