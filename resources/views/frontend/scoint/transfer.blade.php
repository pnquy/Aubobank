@extends('frontend.layouts.app')

@section('content')
    <div class="scoint-container">
        @include('frontend.scoint.includes.scoint_tabs')
        <div class="scoint-section">
            <div class="tab-content">
                <div class="tab-pane fade show active scoint-tab-pane">
                    <h3>
                        <x-forms.post action="{{ route('frontend.scoint.transfer') }}" noValidate>
                            <button class="btn payment-gateway-table-action-btn">
                                <i class="fas fa-envelope  payment-gateway-table-action-btn-icon"></i>
                                Chuyển coint
                            </button>
                        </x-forms.post>

                    </h3>
                    <!-- Nội dung của tab 1 -->
                </div>
                <div id="tab2" class="tab-pane fade">
                    <h3>Tab 2 Content</h3>
                    <!-- Nội dung của tab 2 -->
                </div>
                <div id="tab3" class="tab-pane fade">
                    <h3>Tab 3 Content</h3>
                    <!-- Nội dung của tab 3 -->
                </div>
            </div>

        </div>
    </div>
@endsection
