@props(['title' => null])

<div {{ $attributes->merge(['class' => 'card']) }}>
    @if($title)
        <h3 style="margin-bottom: 15px; font-weight: bold;">{{ $title }}</h3>
    @endif
    {{ $slot }}
</div>