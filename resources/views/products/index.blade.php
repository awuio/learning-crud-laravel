<x-app-layout>
    <x-slot name="header">
        <h2 class="text-base font-semibold text-zinc-900 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Statistics Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Category Filter -->
                <div class="bg-white border border-zinc-200 rounded-lg p-4 flex flex-col justify-between">
                    <span class="text-xs font-medium text-zinc-500 uppercase tracking-wider">{{ __('Filter by Category') }}</span>
                    <div class="mt-3">
                        <form method="GET" action="{{ route('products.index') }}">
                            <select name="category_id" onchange="this.form.submit()"
                                class="flex h-9 w-full rounded-md border border-zinc-300 bg-white px-3 py-1 text-sm text-zinc-900 shadow-sm focus:outline-none focus:ring-2 focus:ring-zinc-400 focus:border-zinc-400">
                                <option value="">{{ __('All Categories') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Total Products -->
                <div class="bg-white border border-zinc-200 rounded-lg p-4 flex flex-col justify-between">
                    <span class="text-xs font-medium text-zinc-500 uppercase tracking-wider">{{ __('Total Products') }}</span>
                    <span class="text-3xl font-bold text-zinc-900 mt-2">{{ number_format($totalProductsCount) }}</span>
                </div>

                <!-- Total Quantity -->
                <div class="bg-white border border-zinc-200 rounded-lg p-4 flex flex-col justify-between">
                    <span class="text-xs font-medium text-zinc-500 uppercase tracking-wider">{{ __('Total Quantity') }}</span>
                    <span class="text-3xl font-bold text-zinc-900 mt-2">{{ number_format($totalQuantitySum) }}</span>
                </div>

                <!-- Total Stock Value -->
                <div class="bg-white border border-zinc-200 rounded-lg p-4 flex flex-col justify-between">
                    <span class="text-xs font-medium text-zinc-500 uppercase tracking-wider">{{ __('Total Stock Value') }}</span>
                    <span class="text-3xl font-bold text-zinc-900 mt-2">
                        {{ number_format($totalStockValueSum) }}
                    </span>
                </div>
            </div>

            <!-- Products List Card -->
            <div class="bg-white border border-zinc-200 rounded-lg" x-data="{ deleteProductId: null, deleteProductName: '' }">
                <!-- Card Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-200">
                    <div>
                        <h3 class="text-sm font-semibold text-zinc-900">{{ __('Manage Products') }}</h3>
                        <p class="text-xs text-zinc-500 mt-0.5">{{ __('Add, update, or remove physical items in your inventory.') }}</p>
                    </div>
                    <x-primary-button href="{{ route('products.create') }}" class="h-8 px-3 text-xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                        {{ __('Add product') }}
                    </x-primary-button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200">
                        <thead>
                            <tr class="bg-zinc-50">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Image
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Category
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Price (Baht)
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Updated At
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-100">
                            @forelse ($products as $product)
                                <tr class="hover:bg-zinc-50 transition duration-100">
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-zinc-500">
                                        @if ($product->image)
                                            <img src="{{ $product->image_url }}"
                                                alt="Product Image"
                                                class="w-14 h-14 object-cover rounded-md border border-zinc-200">
                                        @else
                                            <div
                                                class="w-14 h-14 rounded-md bg-zinc-50 flex items-center justify-center text-xs font-semibold text-zinc-400 border border-dashed border-zinc-200">
                                                N/A
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-zinc-900">
                                        {{ $product->name }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-zinc-100 text-zinc-700">
                                            {{ $product->category?->name ?? __('messages.uncategorized') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-zinc-900">
                                        {{ number_format($product->price, 2) }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-zinc-500">
                                        {{ number_format($product->quantity) }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-zinc-500">
                                        {{ $product->updated_at ? $product->updated_at->format('d M Y') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="inline-flex items-center gap-1">
                                            <x-secondary-button href="{{ route('products.edit', $product) }}" class="h-7 px-2.5 text-xs">
                                                {{ __('Edit') }}
                                            </x-secondary-button>
                                            <x-danger-button type="button" variant="link" class="h-7 px-2.5 text-xs"
                                                x-on:click.prevent="deleteProductId = {{ $product->id }}; deleteProductName = {{ Js::from($product->name) }}; $dispatch('open-modal', 'confirm-product-deletion')">
                                                {{ __('Delete') }}
                                            </x-danger-button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-sm text-zinc-400">
                                        No products found. Click "Add product" to build your catalog!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <x-modal name="confirm-product-deletion" focusable maxWidth="sm">
                    <form method="post" x-bind:action="'{{ route('products.destroy', 'PRODUCT_ID') }}'.replace('PRODUCT_ID', deleteProductId)" class="p-6">
                        @csrf
                        @method('DELETE')
                        <h2 class="text-lg font-medium text-zinc-900">
                            Confirm Deletion
                        </h2>
                        <p class="mt-2 text-sm text-zinc-600">
                            Are you sure you want to delete product: <strong class="text-zinc-900" x-text="deleteProductName"></strong>?
                        </p>
                        <div class="mt-6 flex justify-end gap-3">
                            <x-secondary-button type="button" x-on:click="$dispatch('close')">
                                Cancel
                            </x-secondary-button>
                            <x-danger-button>
                                Delete Product
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>

                <!-- Pagination -->
                @if ($products->hasPages())
                    <div class="px-6 py-4 border-t border-zinc-200">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
