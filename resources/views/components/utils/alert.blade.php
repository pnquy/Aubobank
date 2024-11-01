@props(['dismissable' => true, 'type' => 'success', 'ariaLabel' => __('Close')])

<div {{ $attributes->merge(['class' => 'alert alert-' . $type . ' bg-' . $type . ' text-white rounded px-4 py-4 mb-2 h4']) }}
    role="alert">
    {{-- @if ($dismissable)
        <button type="button" class="close" data-dismiss="alert" aria-label="{{ $ariaLabel }}">
            <span aria-hidden="true">&times;</span>
        </button>
    @endif --}}

    {{ $slot }}
</div>
