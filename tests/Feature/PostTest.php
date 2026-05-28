<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['is_admin' => true]);
    $this->user = User::factory()->create(['is_admin' => false]);
});

test('admin can view posts index', function () {
    Post::factory()->count(3)->create();

    $response = $this->actingAs($this->admin)->get(route('posts.index'));

    $response->assertStatus(200);
    $response->assertViewHas('posts');
});

test('non-admin cannot view posts index', function () {
    $response = $this->actingAs($this->user)->get(route('posts.index'));

    $response->assertStatus(403);
});

test('admin can create a new post', function () {
    $category = \App\Models\Category::factory()->create();

    $response = $this->actingAs($this->admin)->post(route('posts.store'), [
        'title' => 'My First Post',
        'text' => 'This is the content of my first post.',
        'category_id' => $category->id,
    ]);

    $response->assertRedirect(route('posts.index'));
    $this->assertDatabaseHas('posts', [
        'title' => 'My First Post',
    ]);
});

test('admin can update a post', function () {
    $post = Post::factory()->create(['title' => 'Old Title']);

    $response = $this->actingAs($this->admin)->put(route('posts.update', $post), [
        'title' => 'New Awesome Title',
        'text' => $post->text,
        'category_id' => $post->category_id,
    ]);

    $response->assertRedirect(route('posts.index'));
    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'New Awesome Title',
    ]);
});

test('admin can soft delete a post', function () {
    $post = Post::factory()->create();

    $response = $this->actingAs($this->admin)->delete(route('posts.destroy', $post));

    $response->assertRedirect(route('posts.index'));
    $this->assertSoftDeleted($post);
});
