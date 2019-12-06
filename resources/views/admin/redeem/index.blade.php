@extends('admin.layout.base')

@section('redeem')
    active
@endsection

@section('brand')
    Redeem
@endsection

@section('content')

    <!-- Page content -->
    <div class="container-fluid mt--7">
        
        <div class="row" style="margin-bottom:5px;">
            <div class="col">
              <div class="card shadow">
                  <div class="card-header text-center">
                      <img src="{{asset('img/profile/person.png')}}" width="150" class="rounded profile">
                  </div>
                  <div class="card-body">
                    <form>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Customer ID</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control customer-id" placeholder="Customer ID" value="" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Customer Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control customer-name" placeholder="Customer Name" value="" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Card Type</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control card-type" placeholder="Card Type" value="" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Total Point</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control total-point" placeholder="Total Point" value="" readonly>
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
            </div>
        </div>

        <div class="row" style="margin-bottom:5px;">
          <div class="col">
            <div class="card card-profile shadow">
                <div class="card-body">
                    <form method="post" action="#" class="redeem-point">
                        <div class="row">
                            <div class="col">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-qrcode"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Customer ID" name="keyword" disabled>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          </div>
        </div>

        <div class="row" style="margin-bottom:5px;">
          <div class="col">

            <ul class="nav nav-tabs nav-fill" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#point">Point</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#reward">Reward</a>
              </li>
            </ul>
            
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="point" >
                <div class="card card-profile shadow" style="border-radius:0px;">
                  <div class="card-body">
                      <form method="post" action="#" class="redeem-point">
                          <div class="row">
                              <div class="col">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>
                                  </div>
                                  <input type="text" class="form-control num-format" placeholder="Transaction Bill" name="value" required disabled>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                    <div>
                                      <button type="submit" class="btn btn-block btn-primary btn-redeem-point" disabled>Redeem Point</button>
                                    </div>
                                </div>
                              </div>
                          </div>
                      </form>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="reward">
                <div class="card card-profile shadow" style="border-radius:0px;">
                    <div class="card-body">
                        <form method="post" action="#" class="redeem-coupon">
                            <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Points" name="reward" required disabled>
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                      <div>
                                        <button type="submit" class="btn btn-block btn-primary btn-redeem-coupon" data-coupon="0" disabled>Redeem Coupon</button>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col text-center coupon-ajax">  
                              </div>
                            </div>
                        </form>
                    </div>
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
  $('input[name="keyword"]').prop('disabled', false).focus();

  $('.num-format').number(true);

  //confirm btn
  $('body').on('click', '.confirm', function(){
      if(confirm('Simpan transaksi ?')){
          return true;
      }else{
          return false;
      }
  });

  var keyword;
  var id;
  var ruleId;
  var search = true;
  var collectedPoint = 0;
  var couponPoint = 0;
  var couponCount = 0;
  var inpTransaksi = $('input[name="value"]');
  var btnRedeemPoint = $('.btn-redeem-point');
  var inpPoint = $('input[name="reward"]');
  var btnRedeemCoupon = $('.btn-redeem-coupon');
  var btnHistory = $('.btn-history');
  var profile = $('.profile');
  var customerId = $('.customer-id');
  var customerName = $('.customer-name');
  var cardType = $('.card-type');
  var totalPoint = $('.total-point');

  function generate(k){
      if(search){
          $.ajax({
              url : '{!! route('public.search') !!}',
              data : {search : k},
              method : 'POST'
          }).done(function (response){
              console.log(response);

              if(response.data.length == 1){
                  info = response.data[0];
                  keyword = k;
                  id = info.id;
                  ruleId = info.rule_id;
                  collectedPoint = response.point;
                  couponPoint = response.coupon_rule.point;
                  
                  (info.profile == null) ? profile.attr('src', '../img/profile/person.png') : profile.attr('src', '../img/profile/'+info.profile);
                  customerId.val(info.customer_code);
                  customerName.val(info.name);
                  cardType.val(info.rule.card_name);
                  totalPoint.val(numeral(response.point).format('0,0'));

                  //enable input value transaksi dan point redeem btn
                  inpTransaksi.prop('disabled', false).focus();
                  btnRedeemPoint.prop('disabled', false);

                  //coupon reward
                  if(response.point >= response.coupon_rule.point){
                    couponCount = Math.floor(collectedPoint / couponPoint);
                    inpPoint.prop('disabled', false).val(response.point);
                    btnRedeemCoupon.prop('disabled', false).text('Redeem Coupon x'+couponCount);

                    reward.update({
                      min : couponPoint,
                      max : collectedPoint - (collectedPoint % couponPoint),
                      from : collectedPoint,
                      step : couponPoint,
                      onChange : function(data) {
                          collectedPoint = data.from;
                          couponCount = data.from / couponPoint;
                          btnRedeemCoupon.text('Redeem Coupon x'+couponCount);
                      }
                    });
                  }else{
                    couponCount = 0;
                    inpPoint.prop('disabled', true).val(0);
                    btnRedeemCoupon.prop('disabled', true).text('Redeem Coupon');

                    reward.update({
                      min : 0,
                      max : 0,
                      from : 0,
                      step : couponPoint
                    });
                  }

                  $.ajax({
                      url : '{!! route('public.history') !!}',
                      data : { customer_id : info.id },
                      beforeSend : function(){
                          $('.history').text('Loading..');
                      }
                  }).done(function (history){
                      inpTransaksi.prop('disabled', false);
                      btnHistory.prop('disabled', false);

                      $('.history').html(history);

                      table = $('.dt').DataTable({
                          "autoWidth": true
                      });

                      table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                          var data = this.data();
                          data[1] = numeral(data[1]).format('0,0');
                          data[2] = numeral(data[2]).format('0,0');
                          this.data(data)
                      });
                  });

              }else{
                  alert('Customer data not found');
                  //disable input value transaksi dan point redeem btn
                  inpTransaksi.prop('disabled', true);
                  btnRedeemPoint.prop('disabled', true);
                  
                  //disable coupon code dll
                  inpPoint.prop('disabled', true);
                  btnRedeemCoupon.prop('disabled', true);

                  $('.coupon-ajax').html('');

                  clear();
              }
          });
      }
  }

  function clear(){
      profile.attr('src', '../img/profile/person.png');
      customerId.val('Customer ID');
      customerName.val('Customer Name');
      cardType.val('Card Type');
      totalPoint.val('Total Point');
      $('.history').text('Customer data not found');
  }

  btnRedeemPoint.click(function(e) {
      e.preventDefault();
      
      if(parseFloat(inpTransaksi.val()) < 1 || inpTransaksi.val() == ''){
          alert('Nilai transaksi tidak boleh 0');
          inpTransaksi.focus();
      }else{
          $(this).prop('disabled', true);

          $.ajax({
              url : '{!! route('point.redeem.point') !!}',
              data : {
                  customer_id : id,
                  rule_id : ruleId,
                  amount : inpTransaksi.val()
              },
              method : 'POST'
          }).done(function (response){

              if(response.status){
                  alert(response.msg);
                  generate(keyword);

                  inpTransaksi.val('').prop('disabled', true);
                  $('input[name="keyword"]').focus();
              }else{
                  alert(response.msg);
                  btnRedeemPoint.prop('disabled', false);
                  inpTransaksi.focus();
              }
          });
      }
  });

  btnRedeemCoupon.click(function(e) {
    e.preventDefault();
    $(this).prop('disabled', true);

    $.ajax({
        url : '{!! route('point.redeem.coupon') !!}',
        data : {
          coupon_count : couponCount,
          customer_id : id,
          point : collectedPoint,
          coupon_point : couponPoint
        },
        method : 'POST'
      }).done(function(response) {
        if(response.status){
          alert(response.msg);
          code = $('input[name="keyword"]').val();
          generate(code);

          $(this).prop('disabled', true);

          $('.coupon-ajax').html('<a href="redeem/'+id+'/print" class="btn btn-success btn" target="_blank"><i class="fas fa-print fa-fw"></i> Print Coupon</a>');
        }
      });
  });

  $('body').on('submit', 'form.redeem-point', function(e) {
      e.preventDefault()

      var code = $('input[name="keyword"]').val();
      if(code.length > 2){
          generate(code);
      }else{
          clear();
      }
  });

  $('input[name="reward"]').ionRangeSlider({
    skin: "round",
    min : 0,
    max : 0,
    from : 0,
    step : 0,
  });
  
  let reward = $('input[name="reward"]').data("ionRangeSlider");

  $('body').on('submit', 'form.redeem-coupon', function(e) {
    e.preventDefault();

    var code = $('input[name="keyword"]').val();

    if(code.length > 2){
        generate(code);
    }else{
        clear();
    }
  });

});
</script>
@endpush