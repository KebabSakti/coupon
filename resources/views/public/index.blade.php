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
    Argon Dashboard - Free Dashboard for Bootstrap 4 by Creative Tim
  </title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
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
    <div class="header d-flex align-items-center" style="min-height: 100px; background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
    </div>

    <!-- Page content -->
    <div class="container-fluid" style="margin-top:-30px;">
      <div class="row" style="margin-bottom:5px;">
        <div class="col">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="../img/brand/LOGO.PNG" class="rounded-circle profile">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <!--
                <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                -->
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading transaksi">0</span>
                      <span class="description">Transaksi</span>
                    </div>
                    <div>
                      <span class="heading nilai">0</span>
                      <span class="description">Total</span>
                    </div>
                    <div>
                      <span class="heading point">0</span>
                      <span class="description">Point</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3 class="nama">
                  Nama Kustomer
                </h3>
                <div class="h5 font-weight-300 notlp">
                  <i class="ni location_pin mr-2"></i>No Telp Kustomer
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>
                </div>
                <div class="alamat">
                  <i class="ni education_hat mr-2"></i>Alamat Kustomer
                </div>
                <br>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row" style="margin-bottom:5px;">
          <div class="col">
            <div class="card card-profile shadow">
                <div class="card-body">
                    <form class="redeem-point">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="keyword" placeholder="Kode / Nama / No. Hp Kustomer" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control num-format" name="nilai_transaksi" placeholder="Total Nilai Transaksi" required disabled>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-block btn-history" disabled>Redeem</button>
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
                            <h3 class="mb-0">Riwayat Transaksi</h3>
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
        /*
        var table = $('.dt-ajax').DataTable({
            dom: 'tp',
            processing: true,
            serverSide: true,
            columns:[
                {'searchable':false, 'orderable':true},
                {'searchable':false, 'orderable':false},
                {'searchable':false, 'orderable':false},
                {'searchable':false, 'orderable':false},
            ],
            order: [[0, "desc"]],
            ajax: $.fn.dataTable.pipeline({
                url: '{!! route('public.history') !!}',
                data : {
                    'id' : 1 
                },
                pages: 5
            })
        });
        */

        $('input[name="keyword"]').focus();

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

        function generate(k){
            if(search){
                $.ajax({
                    url : '{!! route('public.search') !!}',
                    data : {search : k},
                    method : 'POST'
                }).done(function (response){
                    if(response.data.length == 1){
                        info = response.data[0];
                        keyword = k;
                        id = info.id;
                        
                        (info.profile == null) ? profile.attr('src', '../img/brand/LOGO.PNG') : profile.attr('src', '../img/profile/'+info.profile);
                        transaksi.text(response.transaksi);
                        nilai.text(numeral(response.nilai).format('0,0'));
                        point.text(numeral(response.point).format('0,0'));
                        nama.text(info.name);
                        notlp.text(info.phone);
                        alamat.text(info.address);

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
                        clear();
                    }
                });
            }
        }

        function clear(){
            //$('input[name="keyword"]').val('');
            inpTransaksi.val('');
            inpTransaksi.prop('disabled', true);
            btnHistory.prop('disabled', true);
            $('.history').text('Data kustomer tidak ditemukan');
            transaksi.text(0);
            nilai.text(0);
            point.text(0);
            nama.text('Nama Kustomer');
            notlp.text('No Telp Kustomer');
            alamat.text('Alamat Kustomer');
        }

        btnHistory.click(function(e) {
            e.preventDefault();
            
            if(parseFloat(inpTransaksi.val()) < 1 || inpTransaksi.val() == ''){
                alert('Nilai transaksi tidak boleh 0');
                inpTransaksi.focus();
            }else{
                $(this).prop('disabled', true);

                $.ajax({
                    url : '{!! route('public.redeem') !!}',
                    data : {
                        customer_id : id,
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
                        btnHistory.prop('disabled', false);
                        inpTransaksi.focus();
                    }
                });
            }
        });

        $('body').on('change', 'input[name="keyword"]', function() {
            if($(this).val().length > 2){
                generate($(this).val());
            }else{
                clear();
            }
        });

        /*
        inpTransaksi.blur(function() {
            $(this).prop('disabled', true);
            btnHistory.prop('disabled', true);
        });
        */
    });
</script>
</body>

</html>