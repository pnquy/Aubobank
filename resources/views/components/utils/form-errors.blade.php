@props(['id', 'errors'])
<div {{ $attributes->merge(['class' => 'toast info-toast']) }} id="{{ $id }}" role="alert"
    aria-live="assertive" aria-atomic="true">
    <div class="bg-danger info-toast-content">
        <div class="info-toast-content-left">
            <i class="fa-solid fa-circle-xmark text-white info-toast-icon"></i>
        </div>
        <div class="info-toast-content-right">
            <div class="info-toast-list">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <li class="text-white info-toast-item">{{ $error }}</li>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</div>


@push('after-scripts')
    <script>
        $(document).ready(function() {
            const id = "{{ $id }}"; // Lấy giá trị của biến id từ component
            const exampleToast = $("#" + id);
            exampleToast.toast({
                delay: 10000, // Độ trễ 10 giây (10,000 milliseconds)
            });

            if({{ $errors->any() ? 'true' : 'false' }}) {
                exampleToast.toast("show");
            }
            
        })
    </script>
@endpush
