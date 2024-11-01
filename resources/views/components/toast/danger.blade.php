@props(['id', 'title', 'description'])

<div {{ $attributes->merge(['class' => 'toast info-toast']) }} id="{{ $id }}" role="alert"
    aria-live="assertive" aria-atomic="true">
    <div class="bg-danger info-toast-content">
        <div class="info-toast-content-left">
            <i class="fa-solid fa-circle-xmark text-white info-toast-icon"></i>
        </div>
        <div class="info-toast-content-right">
            <div class=" text-white info-toast-title">{{ $title }}</div>
            <div class=" text-white info-toast-description">{{ $description }}</div>
        </div>
    </div>
</div>
