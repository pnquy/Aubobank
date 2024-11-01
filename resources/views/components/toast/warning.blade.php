@props(['id', 'title', 'description'])

<div {{ $attributes->merge(['class' => 'toast info-toast']) }} id="{{ $id }}" role="alert"
    aria-live="assertive" aria-atomic="true">
    <div class="bg-warning info-toast-content">
        <div class="info-toast-content-left">
            <i class="fa-solid fa-triangle-exclamation text-dark info-toast-icon"></i>
        </div>
        <div class="info-toast-content-right">
            <div class="text-dark info-toast-title">{{ $title }}</div>
            <div class="text-dark info-toast-description">{{ $description }}</div>
        </div>
    </div>
</div>
