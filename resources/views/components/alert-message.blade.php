@props(['type' => 'success'])

<div {{ $attributes->merge(['class' => 'card']) }} style="margin-bottom: 20px; padding: 15px; border-left: 4px solid {{ $type === 'success' ? 'green' : ($type === 'error' ? 'red' : 'blue') }};">
    {{ $slot }}
</div>