@extends('admin.layout.base')

@section('setting')
    active
@endsection

@section('brand')
    Detail Setting
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
                            <h3 class="mb-0">Card Detail ({{$data->card_name}})</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('rule.update', $data->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Card Name</label>
                            <input type="text" class="form-control" name="card_name" value="{{$data->card_name}}" required>
                        </div>
                        <div class="form-group">
                            <label>Value</label>
                            <input type="text" class="form-control num-format num-format" name="value" value="{{$data->value}}" required>
                        </div>
                        <div class="form-group">
                            <label>Point</label>
                            <input type="text" class="form-control num-format num-format" name="point" value="{{$data->point}}" required>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{route('rule.index')}}" class="btn btn-warning">Cancel</a>
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