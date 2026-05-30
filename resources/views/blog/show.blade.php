<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-900 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-8 bg-zinc-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumb Navigation -->
            <nav class="flex mb-6 text-sm text-zinc-500" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('blog') }}" class="inline-flex items-center text-zinc-600 hover:text-zinc-900 transition-colors">
                            {{ __('Blog') }}
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-zinc-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-zinc-400 md:ml-2 font-medium truncate max-w-xs sm:max-w-md">
                                {{ $post->title }}
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Single Post Content Area -->
                <main class="lg:col-span-3 space-y-6">
                    <div class="bg-white border border-zinc-200 rounded-xl p-8 shadow-sm">
                        
                        <!-- Post Meta Header -->
                        <div class="space-y-4 pb-6 border-b border-zinc-100">
                            <div class="flex items-center gap-2 text-xs text-zinc-500">
                                <span>{{ __('Published') }} {{ $post->created_at ? $post->created_at->format('M d, Y') : 'N/A' }}</span>
                                <span>•</span>
                                <span>{{ $post->created_at ? $post->created_at->diffForHumans() : '' }}</span>
                                @if($post->category)
                                    <span>•</span>
                                    <span class="inline-flex items-center rounded-md bg-zinc-100 px-2.5 py-0.5 text-xs font-semibold text-zinc-800 ring-1 ring-inset ring-zinc-600/10">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                            </div>
                            
                            <h1 class="text-3xl font-extrabold text-zinc-900 tracking-tight leading-tight">
                                {{ $post->title }}
                            </h1>
                        </div>

                        <!-- Post Body Content -->
                        <div class="py-8 prose prose-zinc max-w-none">
                            <p class="text-zinc-700 text-base leading-relaxed whitespace-pre-line">
                                {{ $post->text }}
                            </p>
                        </div>

                        <!-- Back Button footer -->
                        <div class="pt-6 border-t border-zinc-100 flex justify-between items-center">
                            <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-zinc-200 bg-white rounded-lg text-sm font-medium text-zinc-700 hover:bg-zinc-50 transition-all shadow-sm">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                                </svg>
                                {{ __('Back to Blog') }}
                            </a>
                        </div>
                    </div>
                </main>
                
                <!-- Sidebar Sections -->
                <aside class="space-y-6">
                    <div class="bg-white border border-zinc-200 rounded-xl p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4 pb-2 border-b border-zinc-100">
                            <h2 class="text-sm font-bold text-zinc-900 uppercase tracking-wider">{{ __('Categories') }}</h2>
                            @if(request('category_id'))
                                <a href="{{ route('blog') }}" class="text-xs text-zinc-500 hover:text-zinc-900 hover:underline flex items-center gap-1">
                                    {{ __('Clear Filter') }}
                                </a>
                            @endif
                        </div>
                        
                        <nav class="space-y-1">
                            <a href="{{ route('blog') }}" 
                               class="group flex items-center justify-between px-3 py-2 text-sm font-medium rounded-md transition-all {{ !request('category_id') ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                                <span>{{ __('All Categories') }}</span>
                            </a>
                            
                            @foreach ($categories as $category)
                                <a href="{{ route('blog', ['category_id' => $category->id]) }}"
                                   class="group flex items-center justify-between px-3 py-2 text-sm font-medium rounded-md transition-all {{ request('category_id') == $category->id ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                                    <span class="truncate">{{ $category->name }}</span>
                                </a>
                            @endforeach
                        </nav>
                    </div>
                </aside>
                
            </div>
        </div>
    </div>
</x-app-layout>
