<!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
@php
    $classes="text-xs text-gray-500 hover:text-gray-900";
@endphp
<a {{ $attributes->merge([ 'class' => $classes]) }}>
    {{ $slot }}
</a>
