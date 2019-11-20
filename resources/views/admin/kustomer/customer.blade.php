@extends('admin.layout.base')

@section('customer')
    active
@endsection

@section('brand')
    Kustomer
@endsection

@section('content')
    @component('component.modal', ['target' => 'kustomer'])
        @slot('title')
            TAMBAH DATA
        @endslot

        <form method="POST" action="{{route('customer.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label>No. Telp</label>
                <input type="text" class="form-control" name="phone">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="address" class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" class="form-control" name="profile">
            </div>
            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    @endcomponent

    <!-- Page content -->
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">List Kustomer</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="#!" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#kustomer"><i class="fas fa-plus-circle fa-fw"></i> Tambah Data</a>
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
                                    <th class="text-center">Kode Kustomer</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">No. Telp</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Tgl. Daftar</th>
                                    <th class="text-center">Update Terakhir</th>
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
            {'searchable':true, 'orderable':false},
            null,
            {'searchable':true, 'orderable':false},
            {'searchable':true, 'orderable':false},
            null,
            null,
            {'searchable':false, 'orderable':false},
        ],
        order: [[4, "desc"]],
        ajax: $.fn.dataTable.pipeline({
            url: '{!! route('customer.index.dt') !!}',
            pages: 5
        })
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