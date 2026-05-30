<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['is_admin' => true]);
    $this->user = User::factory()->create(['is_admin' => false]);
});

test('admin can view dashboard', function () {
    $response = $this->actingAs($this->admin)->get(route('dashboard'));

    $response->assertStatus(200);
});

test('non-admin cannot view dashboard', function () {
    $response = $this->actingAs($this->user)->get(route('dashboard'));

    $response->assertStatus(403);
});

test('guest cannot view dashboard', function () {
    $response = $this->get(route('dashboard'));

    $response->assertRedirect(route('login'));
});
