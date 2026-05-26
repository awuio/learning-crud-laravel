<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $product->name }}
            </h2>
            <a href="{{ route('shop') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors shadow-sm gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                {{ __('Back to Shop') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-[calc(100vh-65px)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-slate-100">
                <div class="p-6 sm:p-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">

                        <!-- Left Column: Premium Image Frame -->
                        <div
                            class="relative group rounded-2xl overflow-hidden border border-slate-100 bg-slate-50 shadow-inner">
                            <img src="{{ $product->image ? (str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image)) : 'https://placehold.co/800x600/png?text=No+Image' }}"
                                alt="{{ $product->name }}"
                                class="h-auto object-cover max-h-[480px] w-full transition-transform duration-500 group-hover:scale-105">

                            <!-- Premium Glassmorphism View Count Overlay -->
                            <div
                                class="absolute top-4 right-4 backdrop-blur-md bg-white/80 border border-white/40 px-3.5 py-1.5 rounded-full shadow-sm flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor"
                                    class="w-4 h-4 text-indigo-600 animate-pulse">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">
                                    {{ number_format($product->views) }} {{ __('views') }}
                                </span>
                            </div>
                        </div>

                        <!-- Right Column: Product Information -->
                        <div class="flex flex-col h-full justify-between">
                            <div>
                                <!-- Category Badge -->
                                @if ($product->category)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100 mb-4">
                                        {{ $product->category->name }}
                                    </span>
                                @endif

                                <!-- Product Title -->
                                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">
                                    {{ $product->name }}
                                </h1>

                                <!-- Rating / views subtext -->
                                <div class="flex items-center gap-4 text-sm text-slate-500 mb-6">
                                    <span class="flex items-center gap-1">
                                        <!-- Mini View Count in Text -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-slate-400">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        {{ number_format($product->views) }} views since launch
                                    </span>
                                </div>

                                <!-- Price Box -->
                                <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5 mb-6">
                                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">
                                        {{ __('Price') }}</p>
                                    <div class="flex items-baseline gap-2">
                                        <span
                                            class="text-3xl font-black text-indigo-600">฿{{ number_format($product->price, 2) }}</span>
                                        <span class="text-sm text-slate-500">/ unit</span>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="prose prose-slate max-w-none mb-8">
                                    <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                        {{ __('Product Description') }}</h3>
                                    <p class="text-slate-600 leading-relaxed whitespace-pre-line">
                                        {{ $product->description ?: 'No description available for this product.' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Inventory and Actions -->
                            <div class="border-t border-slate-100 pt-6">
                                <!-- Inventory Status Badge -->
                                <div class="flex items-center justify-between mb-6">
                                    <span class="text-sm font-medium text-slate-500">{{ __('Availability') }}</span>
                                    @if ($product->quantity > 0)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100 gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            {{ __('In Stock') }} ({{ $product->quantity }} units)
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-100 gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            {{ __('Out of Stock') }}
                                        </span>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
