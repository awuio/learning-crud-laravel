<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-900 leading-tight">
            {{ __('Our Products') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-zinc-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Products Catalog Section -->
                <main class="lg:col-span-3 space-y-6">
                    <div class="bg-white border border-zinc-200 rounded-xl p-6 shadow-sm">
                        <h2 class="text-xl font-bold text-zinc-900 mb-6 tracking-tight">{{ __('messages.latest_products') }}</h2>
                        
                        <div class="divide-y divide-zinc-100 space-y-6">
                            @forelse ($products as $product)
                                <article class="pt-6 first:pt-0 pb-6 last:pb-0 flex flex-col sm:flex-row gap-6">
                                    @if ($product->image)
                                        <a href="{{ route('shop.show', $product) }}" class="shrink-0 group">
                                            <img src="{{ $product->image_url }}"
                                                alt="{{ $product->name }}"
                                                class="w-full sm:w-36 h-36 object-cover rounded-lg border border-zinc-200 transition duration-300 group-hover:scale-[1.02] group-hover:shadow-sm">
                                        </a>
                                    @else
                                        <a href="{{ route('shop.show', $product) }}" class="shrink-0 group block w-full sm:w-36 h-36 rounded-lg border border-dashed border-zinc-200 bg-zinc-50 flex flex-col items-center justify-center text-zinc-400 gap-1.5 hover:bg-zinc-100/50 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-zinc-300">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                            <span class="text-[10px] font-bold tracking-wider uppercase text-zinc-400">{{ __('messages.no_image') }}</span>
                                        </a>
                                    @endif
                                    
                                    <div class="flex-1 flex flex-col justify-between py-1 min-w-0">
                                        <div class="space-y-2">
                                            <div class="flex items-center justify-between gap-4">
                                                <h3 class="text-lg font-bold text-zinc-900 hover:text-zinc-600 transition-colors truncate tracking-tight">
                                                    <a href="{{ route('shop.show', $product) }}">{{ $product->name }}</a>
                                                </h3>
                                                
                                                <span class="text-lg font-black text-zinc-900 shrink-0">
                                                    ฿{{ number_format($product->price, 0) }}
                                                </span>
                                            </div>
                                            
                                            <p class="text-sm leading-relaxed text-zinc-500 line-clamp-3">
                                                {{ $product->description ?: __('messages.no_description') }}
                                            </p>
                                        </div>
                                        
                                        <div class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-zinc-50 mt-4">
                                            <div class="flex items-center gap-2">
                                                @if ($product->category)
                                                    <span class="inline-flex items-center rounded-md bg-zinc-100 px-2 py-1 text-xs font-semibold text-zinc-800">
                                                        {{ $product->category->name }}
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            <div class="flex items-center gap-3">
                                                <span @class([
                                                    'inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold ring-1 ring-inset',
                                                    'text-emerald-700 bg-emerald-50 ring-emerald-600/10' => $product->quantity > 5,
                                                    'text-amber-700 bg-amber-50 ring-amber-600/10' => $product->quantity > 0 && $product->quantity <= 5,
                                                    'text-red-700 bg-red-50 ring-red-600/10' => $product->quantity === 0,
                                                ])>
                                                    {{ $product->quantity > 0 ? __('messages.in_stock', ['count' => $product->quantity]) : __('messages.out_of_stock') }}
                                                </span>
                                                
                                                <a href="{{ route('shop.show', $product) }}" class="inline-flex items-center text-xs font-semibold text-zinc-900 hover:text-zinc-700">
                                                    {{ __('messages.view_details') }}
                                                    <svg class="ml-1 h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <div class="py-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-zinc-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-semibold text-zinc-900">{{ __('messages.no_products_found') }}</h3>
                                    <p class="mt-1 text-sm text-zinc-500">{{ __('messages.no_products_desc') }}</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination Links -->
                        @if($products->hasPages())
                            <div class="mt-8 pt-6 border-t border-zinc-100">
                                {{ $products->links() }}
                            </div>
                        @endif
                    </div>
                </main>
                
                <!-- Sidebar Section -->
                <aside class="space-y-6">
                    <!-- Categories -->
                    <div class="bg-white border border-zinc-200 rounded-xl p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4 pb-2 border-b border-zinc-100">
                            <h2 class="text-sm font-bold text-zinc-900 uppercase tracking-wider">{{ __('messages.categories') }}</h2>
                            @if(request('category_id'))
                                <a href="{{ route('shop') }}" class="text-xs text-zinc-500 hover:text-zinc-900 hover:underline flex items-center gap-1">
                                    {{ __('messages.clear_filter') }}
                                </a>
                            @endif
                        </div>
                        
                        <nav class="space-y-1">
                            <a href="{{ route('shop') }}" 
                               class="group flex items-center justify-between px-3 py-2 text-sm font-medium rounded-md transition-all {{ !request('category_id') ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                                <span>{{ __('messages.all_products') }}</span>
                            </a>
                            
                            @foreach ($categories as $category)
                                <a href="{{ route('shop', ['category_id' => $category->id]) }}"
                                   class="group flex items-center justify-between px-3 py-2 text-sm font-medium rounded-md transition-all {{ request('category_id') == $category->id ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                                    <span class="truncate">{{ $category->name }}</span>
                                </a>
                            @endforeach
                        </nav>
                    </div>

                    <!-- Popular Products -->
                    <div class="bg-white border border-zinc-200 rounded-xl p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4 pb-2 border-b border-zinc-100">
                            <h2 class="text-sm font-bold text-zinc-900 uppercase tracking-wider">{{ __('messages.popular_products') }}</h2>
                        </div>
                        
                        <ul class="space-y-3">
                            @foreach ($popularProducts as $index => $popProduct)
                                <li class="flex items-start gap-3">
                                    <span @class([
                                        'shrink-0 flex h-5 w-5 items-center justify-center rounded-full text-[10px] font-bold',
                                        'bg-zinc-900 text-white' => $index === 0,
                                        'bg-zinc-150 text-zinc-700 bg-zinc-100' => $index > 0,
                                    ])>#{{ $index + 1 }}</span>
                                    
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('shop.show', $popProduct) }}"
                                            class="text-sm font-medium text-zinc-700 hover:text-zinc-900 transition-colors truncate block"
                                            title="{{ $popProduct->name }}">
                                            {{ $popProduct->name }}
                                        </a>
                                        <span class="text-[10px] text-zinc-400 font-medium flex items-center gap-1 mt-0.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            {{ number_format($popProduct->views) }} {{ __('messages.views') }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
                
            </div>
        </div>
    </div>
</x-app-layout>
