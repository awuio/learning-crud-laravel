<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-around mb-4">
                <div class="border w-1/3 h-20 rounded-md p-4 bg-white">
                    <h1>Category</h1>
                    <h2>
                        <form action="GET" action="{{ route('products.store') }}">
                            <select name="category_id" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </h2>
                </div>
                <div class="border w-1/3 h-20 rounded-md p-4 bg-white">
                    <h1>
                        Total Products:
                    </h1>
                    <h2>{{ $products->count() }}</h2>
                </div>
                <div class="border w-1/3 h-20 rounded-md p-4 bg-white">
                    <h1>
                        Total Quantity:
                    </h1>
                    <h2>{{ $products->sum('quantity') }}</h2>
                </div>
                <div class="border w-1/3 h-20 rounded-md p-4 bg-white">
                    <h1>
                        Total Price: {{-- Total Revenue --}}
                    </h1>
                    <h2>
                        {{ number_format($products->sum(fn($p) => $p->price * $p->quantity)) }} Bath
                    </h2>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('products.create') }}">Add new product</a>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Update At</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td class="text-center">{{ $product->price }}</td>
                                    <td class="text-center">{{ $product->quantity }}</td>
                                    <td class="text-center">{{ $product->updated_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product) }}">Edit</a>
                                        <form action="{{ route('products.destroy', $product) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
