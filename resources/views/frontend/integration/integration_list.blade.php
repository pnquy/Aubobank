@extends('frontend.layouts.app')


@section('content')
    <div class="integration">


        <div class="row integration-list">
            @foreach ($integrations as $index => $integration)
                <div class="col-xl-4 col-12 px-4 py-5">
                    <div class="integration-item">
                        <i class="fa-solid fa-credit-card integration-item-icon"></i>
                        <div class="integration-item-name">{{ $integration->name }}</div>
                        <div class="integration-item-intro">{{ $integration->intro }}</div>

                        @foreach (explode('. ', $integration->description) as $sentence)
                            <div class="integration-item-description">
                                - {{ $sentence }}
                            </div>
                        @endforeach


                        <div class="integration-item-price">
                            <span class="integration-item-price-value">{{ $integration->price }}</span>
                            <sup class="integration-item-price-unit">đ</sup>
                        </div>

                        <div class="btn btn-primary integration-item-purchase-btn">
                            Mua ngay
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
@endsection
