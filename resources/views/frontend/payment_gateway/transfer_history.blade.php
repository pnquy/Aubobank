@php
    function renderStatus($status)
    {
        switch ($status) {
            case 'success':
                return '<span class="text-success">Thành công</span>';
            case 'fail':
                return '<span class="text-danger">Thất bại</span>';
            case 'waiting':
                return '<span class="text-warning">Chờ xác nhận</span>';
            default:
                return $status;
        }
    }
@endphp

@extends('frontend.layouts.app')


@section('content')
    <div class="history">
        <div class="history-top">
            <h2 class="mb-4 history-title">
                Lịch sử chuyển tiền tài khoản XXX
            </h2>
        </div>

        <div class="history-bottom">
            <div class="history-filter">
                <input type="search" class="form-control form-control-sm history-filter-search-input"
                    placeholder="Tìm kiếm giao dịch">

                <i class="fas fa-search history-filter-search-icon"></i>
            </div>


            <div class="history-table-wrapper">
                <table class="table table-striped history-table" role="grid" aria-describedby="table-info">
                    <thead>
                        <tr role="row">
                            <th class="" tabindex="0" aria-controls="example" rowspan="1" colspan="1">
                                Mã giao dịch
                                <i class="fa-solid fa-arrow-up-wide-short table-sort-icon table-sort-icon-active"></i>
                            </th>
                            <th class="" tabindex="0" aria-controls="example" rowspan="1" colspan="1">
                                Thời gian
                                <i class="fa-solid fa-arrow-up-wide-short table-sort-icon"></i>
                            </th>
                            <th class="" tabindex="0" aria-controls="example" rowspan="1" colspan="1">
                                Sđt người nhận
                                <i class="fa-solid fa-arrow-up-wide-short table-sort-icon"></i>
                            </th>
                            <th class="" tabindex="0" aria-controls="example" rowspan="1" colspan="1">
                                Tên người nhận
                                <i class="fa-solid fa-arrow-up-wide-short table-sort-icon"></i>
                            </th>
                            <th class="" tabindex="0" aria-controls="example" rowspan="1" colspan="1">
                                Số tiền
                                <i class="fa-solid fa-arrow-up-wide-short table-sort-icon"></i>
                            </th>
                            <th class="" tabindex="0" aria-controls="example" rowspan="1" colspan="1">
                                Lời nhắn
                                <i class="fa-solid fa-arrow-up-wide-short table-sort-icon"></i>
                            </th>
                            <th class="" tabindex="0" aria-controls="example" rowspan="1" colspan="1">
                                Trạng thái giao dịch
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr role="row">
                                <td>
                                    {{ $transaction['code'] }}
                                </td>
                                <td>
                                    {{ $transaction['time'] }}
                                </td>
                                <td>
                                    {{ $transaction['receiver_phone_number'] }}
                                </td>
                                <td rowspan="1" colspan="1" aria-sort="descending">
                                    {{ $transaction['receiver_name'] }}
                                </td>
                                <td rowspan="1" colspan="1" aria-sort="descending">
                                    <?php
                                    $stringHelper = new App\Helpers\StringHelper();
                                    echo $stringHelper->formatCurrency($transaction['amount']);
                                    ?>
                                    {{-- {{ $transaction['amount'] }} --}}
                                </td>
                                <td rowspan="1" colspan="1" aria-sort="descending">
                                    {{ $transaction['message'] }}
                                </td>
                                <td rowspan="1" colspan="1" aria-sort="descending">
                                    {!! renderStatus($transaction['status']) !!}
                                </td>
                            </tr>
                        @endforeach



                    </tbody>

                </table>
            </div>
            {{-- 
            <x-utils.pagination>
            </x-utils.pagination> --}}
        </div>
    </div>
@endsection
