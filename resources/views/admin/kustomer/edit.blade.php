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
                            <h3 class="mb-0">Detail Kustomer</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('customer.update', $data->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Kode Kustomer</label>
                            <input type="text" class="form-control" name="code_customer" value="{{$data->customer_code}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" value="{{$data->name}}" required>
                        </div>
                        <div class="form-group">
                            <label>No. Telp</label>
                            <input type="text" class="form-control" value="{{$data->phone}}" name="phone">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="address" class="form-control" rows="5">{{$data->address}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <br>
                            <a href="{{asset('img/profile/'.$data->profile)}}" data-fancybox="gallery">
                                <img src="{{asset('img/profile/'.$data->profile)}}" class="img-thumbnail" width="100" style="margin:10px 0px;">
                            </a>
                            <input type="file" class="form-control" name="profile">
                            <i class="text-danger">* Kosongkan jika tidak mengganti foto</i>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('customer.index')}}" class="btn btn-warning">Batal</a>
                                <form method="post" action="{{route('customer.destroy', $data->id)}}" style="display:inline-block;">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-danger confirm" title="Hapus">Hapus Data Kustomer</button>
                                </form>
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