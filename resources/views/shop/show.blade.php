<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-zinc-900 tracking-tight leading-tight">
                {{ $product->name }}
            </h2>
            <a href="{{ route('shop') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 border border-zinc-200 bg-white rounded-lg text-xs font-semibold text-zinc-700 hover:bg-zinc-50 hover:text-zinc-950 transition-all shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                {{ __('messages.back_to_shop') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-zinc-50/50 min-h-[calc(100vh-65px)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden rounded-xl border border-zinc-200 shadow-sm">
                <div class="p-6 sm:p-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">

                        <!-- Left Column: Premium Image Frame -->
                        <div class="relative group rounded-xl overflow-hidden border border-zinc-200 bg-zinc-50 shadow-inner aspect-[4/3] md:aspect-square flex items-center justify-center">
                            @if ($product->image)
                                <img src="{{ $product->image_url }}"
                                    alt="{{ $product->name }}"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.02] bg-zinc-50">
                            @else
                                <div class="w-full h-full bg-zinc-50 flex flex-col items-center justify-center text-zinc-400 gap-2 border-dashed">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-zinc-300">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    <span class="text-xs font-bold tracking-widest uppercase text-zinc-400">{{ __('messages.no_image') }}</span>
                                </div>
                            @endif

                            <!-- Premium Glassmorphism View Count Overlay -->
                            <div class="absolute top-4 right-4 backdrop-blur-md bg-white/90 border border-zinc-200/50 px-3.5 py-1.5 rounded-full shadow-sm flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor"
                                    class="w-3.5 h-3.5 text-zinc-900 animate-pulse">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <span class="text-xs font-bold text-zinc-800 tabular-nums">
                                    {{ number_format($product->views) }} {{ __('messages.views') }}
                                </span>
                            </div>
                        </div>

                        <!-- Right Column: Product Information -->
                        <div class="flex flex-col h-full justify-between">
                            <div>
                                <!-- Category Badge -->
                                @if ($product->category)
                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-semibold bg-zinc-100 text-zinc-800 ring-1 ring-inset ring-zinc-600/10 mb-4">
                                        {{ $product->category->name }}
                                    </span>
                                @endif

                                <!-- Product Title -->
                                <h1 class="text-3xl font-extrabold text-zinc-900 tracking-tight mb-2 leading-tight">
                                    {{ $product->name }}
                                </h1>

                                <!-- Rating / views subtext -->
                                <div class="flex items-center gap-4 text-xs text-zinc-400 font-medium mb-6">
                                    <span class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-zinc-400">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        {{ number_format($product->views) }} {{ __('messages.views') }}
                                    </span>
                                </div>

                                <!-- Price Box -->
                                <div class="bg-zinc-50 border border-zinc-200/60 rounded-xl p-5 mb-6">
                                    <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-1">
                                        {{ __('messages.price') }}
                                    </p>
                                    <div class="flex items-baseline gap-1.5">
                                        <span class="text-3xl font-black text-zinc-900">฿{{ number_format($product->price, 0) }}</span>
                                        <span class="text-xs text-zinc-400 font-semibold">{{ __('messages.per_unit') }}</span>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="prose prose-zinc max-w-none mb-8">
                                    <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2">
                                        {{ __('messages.product_desc_title') }}
                                    </h3>
                                    <p class="text-sm text-zinc-600 leading-relaxed whitespace-pre-line">
                                        {{ $product->description ?: __('messages.no_description') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Inventory Status and Actions -->
                            <div class="border-t border-zinc-100 pt-6">
                                <div class="flex items-center justify-between mb-6">
                                    <span class="text-sm font-medium text-zinc-500">{{ __('messages.availability') }}</span>
                                    @if ($product->quantity > 0)
                                        <span class="inline-flex items-center rounded-md px-2.5 py-0.5 text-xs font-bold ring-1 ring-inset text-emerald-700 bg-emerald-50 ring-emerald-600/10 gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            {{ __('messages.in_stock', ['count' => $product->quantity]) }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-md px-2.5 py-0.5 text-xs font-bold ring-1 ring-inset text-red-700 bg-red-50 ring-red-600/10 gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            {{ __('messages.out_of_stock') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Premium Related Products Section (Shadcn/ui Carousel) -->
            @if ($relatedProducts->isNotEmpty())
                <div class="mt-16">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <span class="p-2 bg-zinc-900 text-white rounded-lg border border-zinc-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-2xl font-extrabold text-zinc-900 tracking-tight">
                                    {{ __('messages.related_products') }}
                                </h3>
                                <p class="text-xs font-semibold text-zinc-400 mt-0.5">
                                    {{ __('messages.related_products_desc') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Carousel Container with AlpineJS controls -->
                    <div class="relative" x-data="{
                        scrollLeft: 0,
                        maxScroll: 0,
                        updateScrollState() {
                            const el = this.$refs.carousel;
                            this.scrollLeft = el.scrollLeft;
                            this.maxScroll = el.scrollWidth - el.clientWidth;
                        },
                        scroll(direction) {
                            const el = this.$refs.carousel;
                            const scrollAmount = el.clientWidth * 0.75;
                            el.scrollBy({
                                left: direction === 'next' ? scrollAmount : -scrollAmount,
                                behavior: 'smooth'
                            });
                        }
                    }" x-init="setTimeout(() => updateScrollState(), 100);
                    window.addEventListener('resize', () => updateScrollState());">
                        
                        <!-- Left Navigation Button (Prev) -->
                        <button x-show="scrollLeft > 5" @click="scroll('prev')"
                            class="absolute -left-5 top-1/2 -translate-y-1/2 z-10 p-2.5 bg-white hover:bg-zinc-900 hover:text-white text-zinc-700 border border-zinc-200 rounded-full shadow-md hover:shadow-lg transition-all duration-200 backdrop-blur-md flex items-center justify-center focus:outline-none"
                            style="display: none;" aria-label="Previous">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>

                        <!-- Carousel Snap Track -->
                        <div x-ref="carousel" @scroll.debounce.50ms="updateScrollState()"
                            class="flex gap-6 overflow-x-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] snap-x snap-mandatory scroll-smooth pb-4 px-1">
                            @foreach ($relatedProducts as $related)
                                <div class="snap-start shrink-0 w-[280px] sm:w-[300px] lg:w-[calc((100%-72px)/4)] flex flex-col">
                                    <div class="group bg-white rounded-xl overflow-hidden border border-zinc-200 shadow-sm hover:shadow-md transition-all duration-200 flex flex-col h-full">
                                        <a href="{{ route('shop.show', $related) }}"
                                            class="relative aspect-square overflow-hidden bg-zinc-50 block">
                                            @if ($related->image)
                                                <img src="{{ $related->image_url }}"
                                                    alt="{{ $related->name }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.02] bg-zinc-50">
                                            @else
                                                <div class="w-full h-full bg-zinc-50 flex flex-col items-center justify-center text-zinc-400 gap-1.5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-zinc-300">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                    </svg>
                                                    <span class="text-[9px] font-bold tracking-wider uppercase text-zinc-400">{{ __('messages.no_image') }}</span>
                                                </div>
                                            @endif

                                            <!-- View Badge Overlay (Premium glassmorphism zinc style) -->
                                            <span class="absolute top-3 right-3 text-[10px] font-bold text-zinc-800 backdrop-blur-md bg-white/90 border border-zinc-200/50 px-2.5 py-1 rounded-full shadow-sm flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                                    class="w-3 h-3 text-zinc-900">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                                {{ number_format($related->views) }}
                                            </span>
                                        </a>
                                        
                                        <div class="p-5 flex flex-col justify-between flex-grow">
                                            <div>
                                                <h4 class="font-bold text-zinc-900 group-hover:text-zinc-600 transition-colors line-clamp-1 mb-1 text-base tracking-tight">
                                                    <a href="{{ route('shop.show', $related) }}">{{ $related->name }}</a>
                                                </h4>
                                                <p class="text-xs text-zinc-400 line-clamp-2 mb-4 font-medium">
                                                    {{ $related->description ?: __('messages.no_description') }}
                                                </p>
                                            </div>
                                            
                                            <div class="flex items-center justify-between border-t border-zinc-100 pt-3 mt-auto">
                                                <span class="text-base font-black text-zinc-900">
                                                    ฿{{ number_format($related->price, 0) }}
                                                </span>
                                                <span @class([
                                                    'inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold ring-1 ring-inset',
                                                    'text-emerald-700 bg-emerald-50 ring-emerald-600/10' => $related->quantity > 0,
                                                    'text-red-700 bg-red-50 ring-red-600/10' => $related->quantity === 0,
                                                ])>
                                                    {{ $related->quantity > 0 ? __('messages.in_stock_short') : __('messages.out_of_stock') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Right Navigation Button (Next) -->
                        <button x-show="scrollLeft < maxScroll - 5" @click="scroll('next')"
                            class="absolute -right-5 top-1/2 -translate-y-1/2 z-10 p-2.5 bg-white hover:bg-zinc-900 hover:text-white text-zinc-700 border border-zinc-200 rounded-full shadow-md hover:shadow-lg transition-all duration-200 backdrop-blur-md flex items-center justify-center focus:outline-none"
                            style="display: none;" aria-label="Next">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
