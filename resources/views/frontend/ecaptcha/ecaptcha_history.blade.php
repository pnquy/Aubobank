@extends('frontend.layouts.app')

@section('content')
    <?php
    $tableHeads = [
        (object) [
            'label' => 'ID',
        ],
        (object) [
            'label' => 'Captcha',
        ],
        (object) [
            'label' => 'Text',
        ],
        (object) [
            'label' => 'Trạng thái',
        ],
        (object) [
            'label' => 'Thời gian',
        ],
        (object) [
            'label' => 'Loại',
        ],
        (object) [
            'label' => 'Số coin',
        ],
    ];
    
    $history = [
        (object) [
            'id' => 1,
            'captchap' => 'captchap',
            'text' => 'text',
            'status' => 'status',
            'time' => 'time',
            'type' => 'type',
            'scoint' => 500,
        ],
        (object) [
            'id' => 2,
            'captchap' => 'captchap',
            'text' => 'text',
            'status' => 'status',
            'time' => 'time',
            'type' => 'type',
            'scoint' => 500,
        ],
    ];
    ?>


    <div class="ecaptcha-history-list">

        <div class="ecaptcha-history-top">
            <h2 class="mb-4 ecaptcha-history-title">
                Lịch sử giải ecatpcha
            </h2>
        </div>

        <div class="ecaptcha-history-bottom">
            <x-forms.get class="ecaptcha-history-filter" id="ecaptchaHistoryFilterForm">
                <input type="search" name="search" class="form-control form-control-sm ecaptcha-history-filter-search-input"
                    placeholder="Tìm kiếm tài khoản" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">

                <i class="fas fa-search ecaptcha-history-filter-search-icon"></i>
            </x-forms.get>


            <div class="ecaptcha-history-table-wrapper">
                <table class="table table-striped ecaptcha-history-table" id="ecaptchaHistorysTable" role="grid"
                    aria-describedby="table-info">
                    <thead>
                        <tr role="row">
                            @foreach ($tableHeads as $col)
                                <th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1">

                                    {{ Str::upper($col->label) }}


                                </th>
                            @endforeach

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $col)
                            <tr role="row">

                                <td>
                                    {{ $col->id }}
                                </td>
                                <td>
                                    {{ $col->captchap }}
                                </td>
                                <td>
                                    {{ $col->text }}
                                </td>
                                <td>
                                    {{ $col->status }}
                                </td>
                                <td>
                                    {{ $col->time }}
                                </td>
                                <td>
                                    {{ $col->type }}
                                </td>
                                <td>
                                    {{ $col->scoint }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>




                </table>
            </div>

            {{-- <x-utils.pagination :paginationData="$paymentGatewayAccounts" /> --}}



        </div>
    </div>
@endsection
