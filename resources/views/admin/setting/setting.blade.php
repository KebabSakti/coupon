@extends('admin.layout.base')

@section('setting')
    active
@endsection

@section('brand')
    Setting Point
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
                            <h3 class="mb-0">Setting</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('rule.update', $data->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Nilai Transaksi</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="amount" class="form-control" required>
                                </div>
                                <div class="col">
                                    <span class="font-weight-bold amount"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Point</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="point" class="form-control" required>
                                </div>
                                <div class="col">
                                    <span class="font-weight-bold point"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary btn-rule">Update Rule</button>
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
    var valAmount = {!! $data->value !!};
    var valPoint = {!! $data->point !!};

    $('input[name="amount"]').ionRangeSlider({
        skin: "round",
        min : 0,
        max : 1000001,
        from : {!! $data->value !!},
        step : 1000,
        onChange : function(data) {
            if(data.from == data.max){
                amount.update({
                    min : data.from - 1,
                    max : data.from + 1000000,
                    from : data.from + (1000000 - 200000),
                    step : 1000
                });
            }else if(data.from == data.max-1000001 && data.from != 0){
                amount.update({
                    min : data.from - 1000000,
                    max : data.max - 1000000,
                    from : data.from - 800000,
                    step : 1000
                });
            }

            valAmount = data.from;

            if(valAmount == 0 || valPoint == 0){
                $('.btn-rule').prop('disabled', true);
            }else{
                $('.btn-rule').prop('disabled', false);
            }
        }
    });

    $('input[name="point"]').ionRangeSlider({
        skin: "round",
        min : 0,
        max : 100001,
        from : {!! $data->point !!},
        step : 10,
        onChange : function(data) {
            if(data.from == data.max){
                point.update({
                    min : data.from - 1,
                    max : data.from + 100000,
                    from : data.from + (100000 - 20000),
                    step : 10
                });
            }else if(data.from == data.max-100001 && data.from != 0){
                point.update({
                    min : data.from - 100000,
                    max : data.max - 100000,
                    from : data.from - 80000,
                    step : 10
                });
            }

            valPoint = data.from;

            if(valAmount == 0 || valPoint == 0){
                $('.btn-rule').prop('disabled', true);
            }else{
                $('.btn-rule').prop('disabled', false);
            }
        }
    });

    let amount = $('input[name="amount"]').data("ionRangeSlider");
    let point = $('input[name="point"]').data("ionRangeSlider");
});
</script>
@endpush