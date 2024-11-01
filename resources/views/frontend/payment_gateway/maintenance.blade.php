@extends('frontend.layouts.app')

@section('content')
    <x-info-modal.warning id="warmingPaymentGatewayMaintenanceModal" title="Thông báo"
        description="Cổng thanh toán đang tạm ngưng để bảo trì">
    </x-info-modal.warning>

    @push('after-scripts')
        <script type="module">
        import { initInfoModal, showInfoModal, customSubmitInfoModalBtn } from "/js/frontend/global/components/modal.js"

        $(document).ready(function() {
            
            showInfoModal(
                "warmingPaymentGatewayMaintenanceModal", 
                {
                    title: "Thông báo",
                    description: "Cổng thanh toán đang tạm ngưng để bảo trì"
                },
                {},
                () => {
                    window.location.href = "/";
                }
            )
            
        });
    </script>
    @endpush
@endsection


{{-- @push('after-scripts')
 
@endpush --}}
