@props(['id', 'title', 'description', 'haveBackBtn', 'backBtnLabel'])

<div {{ $attributes->merge(['class' => 'modal fade']) }} id="{{ $id }}" tabindex="-1" role="dialog"
    aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered info-modal" role="document">
        <div class="modal-content info-modal-content">
            <i class="fa-solid fa-triangle-exclamation text-warning info-modal-icon"></i>
            <div class="info-modal-title">{{ $title }}</div>
            <div class="info-modal-description">{{ $description }}</div>
            @if (isset($content))
                {{ $content }}
            @endif
            <div class="info-modal-action">
                @if (isset($action))
                    {{ $action }}
                @else
                    @if (isset($haveBackBtn) && $haveBackBtn)
                        <button class="info-modal-footer-btn info-modal-back-btn" href="/">
                            @if (isset($backBtnLabel))
                                {{$backBtnLabel}}
                            @else
                                Trở lại
                            @endif
                        </button>
                    @endif
                    <button class="info-modal-footer-btn info-modal-submit-btn" type="button">OK</button>
                @endif
            </div>
        </div>
    </div>
</div>


@push('after-scripts')
    <script type="module">
        import { initInfoModal } from "/js/frontend/global/components/modal.js"
        initInfoModal("{{ $id }}");
    </script>
@endpush
