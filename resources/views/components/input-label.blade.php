@props(['value'])

<label {{ $attributes->merge(['class' => 'x-input-label font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>