@extends('admin.layout.base')

@section('transaction')
    active
@endsection

@section('brand')
    Transaksi
@endsection

@section('content')

    <!-- Page content -->
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Detail Transaksi ({{$data->name}})</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control date-range-picker periode">
                                <div class="input-group-append">
                                    <button class="btn btn-info btn-sm" type="button"><i class="fas fa-calendar-alt"></i></button>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="col">
                            <form action="" method="post" target="_blank">
                                @csrf
                                <input type="hidden" name="search" value="">
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Export PDF"><i class="fas fa-file-pdf"></i> Export</button>
                            </form>
                        </div>
                        -->
                        <div class="col-8">
                            <div class="card-description float-right"></div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm table-bordered dt-ajax">
                            <thead>
                                <tr>
                                    <th class="text-center">Nilai</th>
                                    <th class="text-center">Point</th>
                                    <th class="text-center">Tanggal</th>
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
    var e = $('.card-description');

    var start= '';
    var end = '';
    var search = '';
    
    var table = $('.dt-ajax').DataTable({
        processing: true,
        serverSide: true,
        columns:[
            null,
            null,
            null,
            {'searchable':false, 'orderable':false},
        ],
        order: [[2, "desc"]],
        ajax: $.fn.dataTable.pipeline({
            url: '{!! route('admin.transaksi.detail.data', $id) !!}',
            pages: 5
        })
    });
    
    table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
        var data = this.data();
        data[1] = numeral(data[1]).format('0,0');
        data[2] = numeral(data[2]).format('0,0');
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