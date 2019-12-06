@extends('admin.layout.base')

@section('customer')
    active
@endsection

@section('brand')
    Kustomer
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
                        <div class="col-8">
                            <h3 class="mb-0">Customer Data</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('customer.update', $data->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <legend>Personal Information</legend>
                        <hr>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{$data->name}}" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{$data->phone}}">
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" class="form-control" name="mobile" value="{{$data->mobile}}">
                        </div>
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input type="text" class="form-control" name="postal_code" value="{{$data->postal_code}}">
                        </div>
                        <div class="form-group">
                            <label>Fax</label>
                            <input type="text" class="form-control" name="fax" value="{{$data->fax}}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{$data->email}}">
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
                            <input type="text" class="form-control date-picker" name="birth_date" value="{{Carbon\Carbon::createFromFormat('Y-m-d', $data->birth_date)->Timezone('GMT+8')->format('d/m/Y')}}">
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
                            <textarea name="address" class="form-control" rows="5">{{$data->address}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Photo</label>
                            <br>
                            <a href="{{asset('img/profile/'.$data->profile)}}" data-fancybox="gallery">
                                <img src="{{asset('img/profile/'.$data->profile)}}" class="img-thumbnail" width="100" style="margin:10px 0px;">
                            </a>
                            <input type="file" class="form-control" name="profile">
                            <i class="text-danger">* Keep field empty if not changing picture</i>
                        </div>
                        <legend>VIP</legend>
                        <hr>
                        <div class="form-group">
                            <label>Cardkey Code</label>
                            <input type="text" class="form-control" name="customer_code" value="{{$data->customer_code}}" readonly>
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
                            <input type="text" class="form-control date-picker" name="commence_on" value="{{Carbon\Carbon::createFromFormat('Y-m-d', $data->commence_on)->Timezone('GMT+8')->format('d/m/Y')}}">
                        </div>
                        <div class="form-group">
                            <label>Expires On</label>
                            <input type="text" class="form-control date-picker" name="expires_on" value="{{Carbon\Carbon::createFromFormat('Y-m-d', $data->expires_on)->Timezone('GMT+8')->format('d/m/Y')}}">
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary">Update Data</button>
                                <a href="{{route('customer.index')}}" class="btn btn-warning">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
    <br>
@endsection