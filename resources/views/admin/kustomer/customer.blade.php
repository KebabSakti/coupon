@extends('admin.layout.base')

@section('customer')
    active
@endsection

@section('brand')
    Customer
@endsection

@section('content')
    @component('component.modal', ['target' => 'kustomer'])
        @slot('title')
            ADD DATA
        @endslot

        <form method="POST" action="{{route('customer.store')}}" enctype="multipart/form-data">
            @csrf
            <legend>Personal Information</legend>
            <hr>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" name="phone">
            </div>
            <div class="form-group">
                <label>Mobile</label>
                <input type="text" class="form-control" name="mobile">
            </div>
            <div class="form-group">
                <label>Postal Code</label>
                <input type="text" class="form-control" name="postal_code">
            </div>
            <div class="form-group">
                <label>Fax</label>
                <input type="text" class="form-control" name="fax">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label>Sex</label>
                <select name="sex" class="form-control">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Birth Date</label>
                <input type="text" class="form-control date-picker" name="birth_date">
            </div>
            <div class="form-group">
                <label>Nationality</label>
                <select name="nationality" class="form-control">
                    @foreach ($nationalities as $item)
                        <option value="{{$item->nationality}}">{{$item->nationality}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" class="form-control" name="profile">
            </div>
            <legend>VIP</legend>
            <hr>
            <div class="form-group">
                <label>Cardkey Code</label>
                <input type="text" class="form-control" name="customer_code" required>
            </div>
            <div class="form-group">
                <label>Card Type</label>
                <select name="rule_id" class="form-control" required>
                    @foreach ($rules as $item)
                        <option value="{{$item->id}}">{{$item->card_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Commence On</label>
                <input type="text" class="form-control date-picker" name="commence_on">
            </div>
            <div class="form-group">
                    <label>Expires On</label>
                    <input type="text" class="form-control date-picker" name="expires_on">
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
                            <h3 class="mb-0">Customer List</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#kustomer"><i class="fas fa-plus-circle fa-fw"></i> Add Data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control date-range-picker periode">
                                <div class="input-group-append">
                                    <button class="btn btn-info btn-sm date-filter" type="button">COMMENCE ON</button>
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
                                    <th class="text-center">Customer ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Card Type</th>
                                    <th class="text-center">Points</th>
                                    <th class="text-center">Commence On</th>
                                    <th class="text-center">Expires On</th>
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
    var alt = false;

    $('body').on('click', '.date-filter', function() {
        alt = !alt;
        if(alt){
            $(this).text('EXPIRES ON').removeClass('btn-info').addClass('btn-primary');
        }else{
            $(this).text('COMMENCE ON').removeClass('btn-primary').addClass('btn-info');
        }
    });
    
    var table = $('.dt-ajax').DataTable({
        processing: true,
        serverSide: true,
        columns:[
            {'searchable':true, 'orderable':false},
            null,
            {'searchable':true, 'orderable':false},
            {'searchable':false, 'orderable':false},
            {'searchable':false, 'orderable':false},
            null,
            null,
            {'searchable':false, 'orderable':false},
        ],
        order: [[5, "desc"]],
        ajax: $.fn.dataTable.pipeline({
            url: '{!! route('customer.index.dt') !!}',
            pages: 5
        })
    });
    

    $('.periode').on('apply.daterangepicker', function(e, p){
        start = p.startDate.format('YYYY-MM-DD');
        end = p.endDate.format('YYYY-MM-DD')
        search = table.search();

        table.search(start+'|'+end+'|'+alt).draw();
    });

    table.on('search.dt', function() {
        search = table.search();
        $('input[name="search"]').val(search);
    });
});
</script>
@endpush