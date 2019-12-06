@extends('admin.layout.base')

@section('setting')
    active
@endsection

@section('brand')
    Setting
@endsection

@section('content')
    @component('component.modal', ['target' => 'card'])
    @slot('title')
        ADD DATA
    @endslot

    <form method="POST" action="{{route('rule.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Card Name</label>
            <input type="text" class="form-control" name="card_name" required>
        </div>
        <div class="form-group">
            <label>Value</label>
            <input type="text" class="form-control num-format" name="value" required>
        </div>
        <div class="form-group">
            <label>Point</label>
            <input type="text" class="form-control num-format" name="point" required>
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
        <div class="row mb-2">
            <div class="col">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Point Redeem Setting</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#card"><i class="fas fa-plus-circle fa-fw"></i> Add Data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm table-bordered dt-ajax-coupon">
                            <thead>
                                <tr>
                                    <th class="text-center">Card Type</th>
                                    <th class="text-center">Value</th>
                                    <th class="text-center">Point</th>
                                    <th class="text-center">Date Created</th>
                                    <th class="text-center">Date Updated</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rules as $rule)
                                    <tr>
                                        <td class="text-center">{{$rule->card_name}}</td>
                                        <td class="text-center idr">{{$rule->value}}</td>
                                        <td class="text-center idr">{{$rule->point}}</td>
                                        <td class="text-center">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rule->created_at)->Timezone('GMT+8')->format('d/m/Y H:i:s')}}</td>
                                        <td class="text-center">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rule->updated_at)->Timezone('GMT+8')->format('d/m/Y H:i:s')}}</td>
                                        <td class="text-center">
                                            <a href="{{route('rule.show', $rule->id)}}" class="btn btn-sm btn-info" title="Detail"><i class="fas fa-info"></i> Detail</a>
                                            <form method="post" action="{{route('rule.destroy', $rule->id)}}" style="display:inline-block;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger confirm" title="Hapus"><i class="fas fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Coupon Redeem Setting</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('rule.coupon', $coupon->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Point</label>
                            <input type="text" class="form-control num-format num-format" name="point" value="{{$coupon->point}}" required>
                            <span class="text-danger">* Set how much point to use for 1 coupon reward</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary">Update</button>
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

@push('scripts')
<script>
$(function() {
    
});
</script>
@endpush