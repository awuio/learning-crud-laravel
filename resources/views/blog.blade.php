<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <main class="container mx-auto mt-6 flex gap-6">
        <!-- Blog Posts Section -->
        <section class="w-3/4 bg-white p-6 shadow-md rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Latest Posts</h2>
            <div class="space-y-6">
                @forelse ($posts as $post)
                    <article class="flex gap-4 border-b pb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-indigo-600 hover:text-indigo-900">
                                <a href="#" class="hover:underline">{{ $post->title }}</a>
                            </h3>
                            <p class="text-gray-600 mt-2">{{ Str::limit($post->text, 200) }}</p>
                        </div>
                    </article>
                @empty
                    <p class="text-gray-500 italic">No posts found in this category.</p>
                @endforelse
            </div>
        </section>
        <!-- Sidebar Section -->
        <aside class="w-1/4 bg-white p-6 shadow-md rounded-lg">
            <div class="flex justify-between mb-4">
                <h2 class="text-xl font-semibold">Categories</h2>
                <h4 class="text-base text-gray-600 font-normal hover:underline"><a href="{{ route('blog') }}">Clear</a></h4>
            </div>
            <ul class="space-y-2">
                @foreach ($categories as $category)
                    <li><a href="{{ route('blog', ['category_id' => $category->id]) }}"
                            class="{{ request('category_id') == $category->id ? 'text-gray-800 font-bold underline' : 'text-gray-600 hover:underline' }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </aside>
    </main>

</x-app-layout>
