<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['is_admin' => true]);
    $this->user = User::factory()->create(['is_admin' => false]);
});

test('admin can view categories index', function () {
    Category::factory()->count(3)->create();

    $response = $this->actingAs($this->admin)->get(route('categories.index'));

    $response->assertStatus(200);
    $response->assertViewHas('categories');
});

test('non-admin cannot view categories index', function () {
    $response = $this->actingAs($this->user)->get(route('categories.index'));

    $response->assertStatus(403);
});

test('admin can create a new category', function () {
    $response = $this->actingAs($this->admin)->post(route('categories.store'), [
        'name' => 'New Test Category',
    ]);

    $response->assertRedirect(route('categories.index'));
    $this->assertDatabaseHas('categories', [
        'name' => 'New Test Category',
    ]);
});

test('admin can update a category', function () {
    $category = Category::factory()->create(['name' => 'Old Name']);

    $response = $this->actingAs($this->admin)->put(route('categories.update', $category), [
        'name' => 'Updated Name',
    ]);

    $response->assertRedirect(route('categories.index'));
    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'Updated Name',
    ]);
});

test('admin can soft delete a category', function () {
    $category = Category::factory()->create();

    $response = $this->actingAs($this->admin)->delete(route('categories.destroy', $category));

    $response->assertRedirect(route('categories.index'));
    $this->assertSoftDeleted($category);
});
