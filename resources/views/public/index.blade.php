<!--

=========================================================
* Argon Dashboard - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Redeem Coupon App - SCORE SPORTS AND LOUNGE
  </title>
  <!-- Favicon -->
  <link href="../img/brand/score.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{asset('js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet" />
  <link href="{{asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/datatables.min.css"/>
  <link href="{{asset('css/argon-dashboard.css?v=1.1.0')}}" rel="stylesheet" />
</head>

<body class="">
  <div class="main-content">
    <!-- Header -->
    <div class="text-center bg-primary" style="min-height:300px;">
      <img src="{{asset('img/brand/score.png')}}" width="250" class="img-fluid">
    </div>

    <!-- Page content -->
    <div class="container-fluid" style="margin-top:-120px;">
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

      <div class="row" style="margin-bottom:20px;">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Transaction History</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="history"></div>
                </div>
            </div>
        </div>
    </div>

      <!-- Footer -->
      <!--
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
      -->
    </div>
    
  </div>
  <!--   Core   -->
  <script src="{{asset('js/plugins/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!--   Optional JS   -->
  <script src="{{asset('js/plugins/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{asset('js/plugins/chart.js/dist/Chart.extension.js')}}"></script>
  <script src="{{asset('js/plugins/numeraljs/min/numeral.min.js')}}"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.0/b-colvis-1.6.0/b-html5-1.6.0/b-print-1.6.0/r-2.2.3/datatables.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script type="text/javascript" src="{{asset('js/plugins/jquery-number-master/jquery.number.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/plugins/fancybox-master/dist/jquery.fancybox.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/plugins/datatable/pipelining.js')}}"></script>
  <!--   Argon JS   -->
  <script src="{{asset('js/argon-dashboard.min.js?v=1.1.0')}}"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <!--
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
  -->
  <!-- Custom Script For This Page -->
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
        var kustomer = $('.kustomer');
        var transaksi = $('.transaksi');
        var nilai = $('.nilai');
        var point = $('.point');
        var nama = $('.nama');
        var notlp = $('.notlp');
        var alamat = $('.alamat');
        var inpTransaksi = $('input[name="nilai_transaksi"]');
        var btnHistory = $('.btn-history');
        var profile = $('.profile');
        var id;
        var search = true;

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
                        
                        (info.profile == null) ? profile.attr('src', '../img/profile/person.png') : profile.attr('src', '../img/profile/'+info.profile);
                        customerId.val(info.customer_code);
                        customerName.val(info.name);
                        cardType.val(info.rule.card_name);
                        totalPoint.val(numeral(response.point).format('0,0'));

                        /*
                        transaksi.text(response.transaksi);
                        nilai.text(numeral(response.nilai).format('0,0'));
                        point.text(numeral(response.point).format('0,0'));
                        nama.text(info.name);
                        notlp.text(info.phone);
                        alamat.text(info.address);
                        */

                        $.ajax({
                            url : '{!! route('public.history') !!}',
                            data : { customer_id : info.id },
                            beforeSend : function(){
                                $('.history').text('Loading..');
                            }
                        }).done(function (history){
                            inpTransaksi.prop('disabled', false);
                            btnHistory.prop('disabled', false);

                            //inpTransaksi.val('').focus();

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

                            /*
                            search = false;
                            setTimeout(function() {
                                search = true;
                            }, 2000);
                            */
                        });
                    }else{
                        alert('Customer data not found');
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

        $('body').on('submit', 'form.redeem-point', function(e) {
            e.preventDefault()
            var code = $('input[name="keyword"]').val();

            if(code.length > 2){
                generate(code);
            }else{
                clear();
            }
        });
    });
</script>
</body>

</html>