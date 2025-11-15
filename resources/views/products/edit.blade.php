<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('products.update', $products) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <div>
                                <label for="name">Name:</label>
                            </div>
                            <input type="text" name="name" id="name" value="{{ $product->name }}">
                        </div>
                        <div>
                            <div>
                                <label for="category_id">Category:</label>
                            </div>
                            <select name="category_id" id="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <div>
                                <label for="price">Price:</label>
                            </div>
                            <input type="text" name="price" id="price" value="{{ $product->price }}">
                        </div>
                        <div>
                            <div>
                                <label for="quantity">Quantity:</label>
                            </div>
                            <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}">
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"> 
                                Update
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
