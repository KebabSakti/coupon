<div class="table-responsive">
    <table class="table table-striped table-hover table-sm table-bordered dt">
        <thead>
            <tr>
                <th class="text-center">Transaction Date</th>
                <th class="text-center">Transaction Amount</th>
                <th class="text-center">Point</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction as $r)
                <tr>
                    <td class="text-center">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $r->created_at)->Timezone('GMT+8')->format('d/m/Y H:i:s')}}</td>
                    <td class="text-center num-format">{{$r->value}}</td>
                    <td class="text-center">{{$r->point}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>