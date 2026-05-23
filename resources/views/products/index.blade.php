<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Statistics Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Category Filter -->
                <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg p-5 border border-gray-100 flex flex-col justify-between">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Filter Category</span>
                    <div class="mt-2">
                        <form method="GET" action="{{ route('products.index') }}">
                            <select name="category_id" onchange="this.form.submit()" class="block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm py-1.5 pl-3 pr-10">
                                <option value="">All Categories</option>
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
                <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg p-5 border border-gray-100 flex flex-col justify-between">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Products</span>
                    <span class="text-3xl font-bold text-gray-900 mt-2">{{ $products->count() }}</span>
                </div>

                <!-- Total Quantity -->
                <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg p-5 border border-gray-100 flex flex-col justify-between">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Quantity</span>
                    <span class="text-3xl font-bold text-gray-900 mt-2">{{ $products->sum('quantity') }}</span>
                </div>

                <!-- Total Price/Revenue -->
                <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg p-5 border border-gray-100 flex flex-col justify-between bg-gradient-to-br from-indigo-50 to-white">
                    <span class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">Total Stock Value</span>
                    <span class="text-3xl font-bold text-indigo-900 mt-2">
                        {{ number_format($products->sum(fn($p) => $p->price * $p->quantity)) }}
                    </span>
                </div>
            </div>

            <!-- Products List Card -->
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Manage Products</h3>
                            <p class="text-sm text-gray-500 mt-1">Add, update, or remove physical items in your inventory.</p>
                        </div>
                        <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-hidden focus:border-indigo-950 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-xs">
                            <svg class="w-4.5 h-4.5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                            Add new product
                        </a>
                    </div>

                    <div class="overflow-x-auto border border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Image
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Price (Baht)
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Quantity
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Updated At
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($products as $product)
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-36 h-36 object-cover rounded-md border border-gray-200 shadow-xs">
                                            @else
                                                <div class="w-12 h-12 rounded-md bg-gray-100 flex items-center justify-center text-xs text-gray-400 font-semibold border border-dashed border-gray-300">
                                                    N/A
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $product->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $product->category->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            {{ number_format($product->price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ number_format($product->quantity) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $product->updated_at ? $product->updated_at->format('d M Y') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="inline-flex space-x-2">
                                                <a href="{{ route('products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900 hover:underline px-3 py-1 rounded-md hover:bg-indigo-50 transition">
                                                    Edit
                                                </a>
                                                <form action="{{ route('products.destroy', $product) }}" method="post" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')" class="text-red-600 hover:text-red-900 hover:underline px-3 py-1 rounded-md hover:bg-red-50 transition border-none bg-transparent cursor-pointer font-medium">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-10 text-center text-sm text-gray-500">
                                            No products found. Click "Add new product" to build your catalog!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
