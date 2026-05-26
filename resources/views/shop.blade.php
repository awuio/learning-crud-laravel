<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Our Products') }}
        </h2>
    </x-slot>

    <main class="container mx-auto mt-6 flex gap-6">
        <!-- Blog Posts Section -->
        <section class="w-3/4 bg-white p-6 shadow-md rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Latest Products</h2>
            <div class="space-y-6">
                @foreach ($products as $product)
                    <article class="flex gap-4 border-b pb-4">
                        {{-- <img src="{{ asset('images/placeholder-150x150.png') }}" alt="Product Image" class="w-32 h-32 object-cover rounded-sm"> --}}
                        <a href="{{ route('shop.show', $product) }}" class="shrink-0">
                            <img src="{{ $product->image ? (str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image)) : 'https://placehold.co/600x400/png' }}"
                                alt="Product Image"
                                class="w-32 h-32 object-cover rounded-md transition duration-300 hover:scale-102 hover:shadow-md">
                        </a>
                        <div class="flex flex-col justify-between py-1">
                            <h3 class="text-lg font-semibold">
                                <a href="{{ route('shop.show', $product) }}"
                                    class="text-gray-900 hover:text-indigo-600 transition-colors">
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <p class="text-gray-600 line-clamp-3">{{ $product->description }}</p>
                            <div class="flex gap-4 mt-2">
                                <p class="font-semibold">Price: {{ $product->price }}</p>
                                <p class="font-semibold">Quantity: {{ $product->quantity }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>

        </section>
        <!-- Sidebar Section -->
        <aside class="w-1/4 bg-white p-6 shadow-md rounded-lg">
            <div class="flex justify-between  mb-4">
                <h2 class="text-xl font-semibold">Categories</h2>
                <h4 class="text-base text-gray-600 font-normal hover:underline"><a href="{{ route('shop') }}">Clear</a>
                </h4>
            </div>
            <ul class="space-y-2">
                @foreach ($categories as $category)
                    <li><a href="{{ route('shop', ['category_id' => $category->id]) }}"
                            class="{{ request('category_id') == $category->id ? 'text-gray-800 font-bold underline' : 'text-gray-600 hover:underline' }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>

            <!-- Popular Products Section -->
            <div class="mt-8 border-t pt-6">
                <h2 class="text-xl font-semibold mb-4">Popular Products</h2>
                <ul class="space-y-3">
                    @foreach ($popularProducts as $index => $popProduct)
                        <li class="flex items-start gap-2">
                            <span class="text-xs font-bold text-gray-400 w-5 mt-1">#{{ $index + 1 }}</span>
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('shop.show', $popProduct) }}"
                                    class="text-sm font-medium text-gray-700 hover:text-indigo-600 truncate block transition-colors"
                                    title="{{ $popProduct->name }}">
                                    {{ $popProduct->name }}
                                </a>
                                <span class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    {{ number_format($popProduct->views) }} views
                                </span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </main>

</x-app-layout>
