<!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
@php
    $classes="underline text-sm text-gray-600 hover:text-gray-900";
@endphp
<a {{ $attributes->merge([ 'class' => $classes]) }}>
    {{ $slot }}
</a>
