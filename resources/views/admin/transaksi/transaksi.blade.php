@extends('admin.layout.base')

@section('transaction')
    active
@endsection

@section('brand')
    History
@endsection

@section('content')

    <!-- Page content -->
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row mb-2">
            <div class="col">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Redeem Point History</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm table-bordered dt-ajax">
                            <thead>
                                <tr>
                                    <th class="text-center">Customer ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Transaction</th>
                                    <th class="text-center">Transaction Bill</th>
                                    <th class="text-center">Total Point</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Redeem Coupon History</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sm table-bordered dt-ajax-coupon">
                                <thead>
                                    <tr>
                                        <th class="text-center">Customer ID</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Mobile</th>
                                        <th class="text-center">Total Redeem</th>
                                        <th class="text-center">Point Spent</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection

@push('scripts')
<script>
$(function() {
    var start= '';
    var end = '';
    var search = '';
    
    //point redeem history table
    var table = $('.dt-ajax').DataTable({
        processing: true,
        serverSide: true,
        columns:[
            {'searchable':true, 'orderable':false},
            null,
            {'searchable':true, 'orderable':false},
            {'searchable':false, 'orderable':false},
            {'searchable':false, 'orderable':false},
            {'searchable':false, 'orderable':false},
            {'searchable':false, 'orderable':false},
        ],
        order: [[1, "desc"]],
        ajax: $.fn.dataTable.pipeline({
            url: '{!! route('admin.transaksi.index.data') !!}',
            pages: 5
        })
    });
    
    table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
        var data = this.data();
        data[1] = numeral(data[1]).format('0,0');
        data[2] = numeral(data[2]).format('0,0');
        data[3] = numeral(data[3]).format('0,0');
        data[4] = numeral(data[4]).format('0,0');
        this.data(data)
    });

    //coupon history
    var tableCoupon = $('.dt-ajax-coupon').DataTable({
        processing: true,
        serverSide: true,
        columns:[
            {'searchable':true, 'orderable':false},
            null,
            {'searchable':true, 'orderable':false},
            {'searchable':false, 'orderable':false},
            {'searchable':false, 'orderable':false},
            {'searchable':false, 'orderable':false},
        ],
        order: [[1, "desc"]],
        ajax: $.fn.dataTable.pipeline({
            url: '{!! route('admin.transaksi.coupon.data') !!}',
            pages: 5
        })
    });
    
    tableCoupon.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
        var data = this.data();
        data[1] = numeral(data[1]).format('0,0');
        data[2] = numeral(data[2]).format('0,0');
        data[3] = numeral(data[3]).format('0,0');
        data[4] = numeral(data[4]).format('0,0');
        this.data(data)
    });

    $('.periode').on('apply.daterangepicker', function(e, p){
        start = p.startDate.format('YYYY-MM-DD');
        end = p.endDate.format('YYYY-MM-DD')
        search = table.search();

        table.search(start+'|'+end).draw();
    });

    table.on('search.dt', function() {
        search = table.search();
        $('input[name="search"]').val(search);
    });

});
</script>
@endpush