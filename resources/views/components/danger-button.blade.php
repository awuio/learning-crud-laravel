@props(['href' => null, 'variant' => 'solid'])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium h-9 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-150';
    
    if ($variant === 'link') {
        $variantClasses = 'text-red-600 underline-offset-4 hover:underline active:text-red-700';
    } else {
        $variantClasses = 'bg-red-500 text-white shadow-sm hover:bg-red-600 active:bg-red-700';
    }

    $classes = $baseClasses . ' ' . $variantClasses;
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
