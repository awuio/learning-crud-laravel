<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_detail_page_can_be_rendered(): void
    {
        // 1. Create dependencies
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Tech']);
        
        $product = Product::create([
            'name' => 'MacBook Pro',
            'description' => 'Apple Silicon computer',
            'price' => 59000,
            'quantity' => 10,
            'category_id' => $category->id,
            'views' => 0,
        ]);

        // 2. Access public show page
        $response = $this->actingAs($user)
            ->get(route('shop.show', $product));

        // 3. Assertions
        $response->assertStatus(200);
        $response->assertSee('MacBook Pro');
        $response->assertSee('Apple Silicon computer');
        $response->assertSee('Tech');
        $response->assertSee('1 views'); // Views incremented from 0 to 1
    }

    public function test_product_views_count_increments_on_every_visit(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Fashion']);
        
        $product = Product::create([
            'name' => 'Gucci Bag',
            'price' => 120000,
            'quantity' => 5,
            'category_id' => $category->id,
            'views' => 5, // Starts at 5 views
        ]);

        // 1st visit
        $this->actingAs($user)->get(route('shop.show', $product));
        $this->assertEquals(6, $product->fresh()->views);

        // 2nd visit
        $this->actingAs($user)->get(route('shop.show', $product));
        $this->assertEquals(7, $product->fresh()->views);
    }

    public function test_popular_products_sidebar_renders_correctly(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'General']);
        
        $p1 = Product::create([
            'name' => 'Low View Product',
            'price' => 1000,
            'quantity' => 10,
            'category_id' => $category->id,
            'views' => 5,
        ]);
        
        $p2 = Product::create([
            'name' => 'High View Product',
            'price' => 2000,
            'quantity' => 5,
            'category_id' => $category->id,
            'views' => 50,
        ]);

        $response = $this->actingAs($user)->get(route('shop'));

        $response->assertStatus(200);
        $response->assertSeeInOrder([
            'Popular Products',
            'High View Product',
            '50 views',
            'Low View Product',
            '5 views',
        ]);
    }
}
