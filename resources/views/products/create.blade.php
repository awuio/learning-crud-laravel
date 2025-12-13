<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <div>
                                <label for="name">Name:</label>
                            </div>
                            <input type="text" name="name" id="name"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-xs">
                        </div>
                        <div>
                            <div>
                                <label for="description">Description:</label>
                            </div>
                            <textarea type="text" name="description" id="description"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-xs"></textarea>
                        </div>
                        <div>
                            <div>
                                <label for="price">Price:</label>
                            </div>
                            <input type="text" name="price" id="price"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-xs">
                        </div>

                        <div>
                            <div>
                                <label for="quantity">Quantity:</label>
                            </div>
                            <input type="text" name="quantity" id="quantity"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-xs">
                        </div>
                        <div>
                            <div>
                                <label for="image_url">Image</label>
                            </div>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-xs">

                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <div>
                                <label for="category_id">Category:</label>
                            </div>
                            <select name="category_id" id="category_id"
                                class="rounded-md shadow-xs border-gray-300 focus:border-indigo-300 focus:ring-3 focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Update
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
