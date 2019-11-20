window.TrackJS &&
TrackJS.install({
    token: "ee6fab19c5a04ac1a32a645abde4613a",
    application: "argon-dashboard-free"
});

$(function() {
    //alert window auto dismiss
    if($('.alert').length > 0){
        setTimeout(function() {
            $('.alert').fadeOut('fast');
        }, 5000);
    }
    //format number
    if($('.idr').length > 0){
        $('.idr').each(function() {
            $(this).text(numeral($(this).text()).format('0,0'));
        });
    }
    //format number on change
    $('body').on('keyup', '.num-format', function() {
        pokok = parseFloat($('input[name="hutang_pokok"]').val());
        bunga = parseFloat($('input[name="bunga"]').val());
        denda = parseFloat($('input[name="denda"]').val());
        total = pokok+bunga+denda;

        $('input[name="total"]').val(total);
    });
    $('.num-format').number(true);
    //data table init
    $('.data-table').DataTable({
        "autoWidth": false
    });
    //date picker
    $('.date-picker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
    //date range picker
    $('.date-range-picker').daterangepicker({
        'locale': {
            'format': 'DD/MM/YYYY'
        }
    });
    //clear search input on click
    $('body').on('click', 'input[type="search"]', function() {
        $(this).val('');
    });
    //popover
    $('[data-toggle="popover"]').popover({
        container: 'body',
    });
    //tooltip
    $('[data-toggle="tooltip"]').tooltip();
    //no click on link
    $('body').on('click', '.no-click', function(e) {
        e.preventDefault();
    });
    //confirm btn
	$('body').on('click', '.confirm', function(){
		if(confirm('Proses ini tidak dapat dikembalikan. lanjutkan?')){
			return true;
		}else{
			return false;
		}
	});
    //edit mode
    $('.edit-btn').on('click', function() {
        disabled = $('.edit').find('input, select, textarea, button').not(':hidden');

        disabled.each(function() {
            prop = ($(this).prop('disabled') != true);

            $(this).attr('disabled', prop);
        });
    });
    //add lampiran
    $('.lampiran-btn').on('click', function() {
        lampiran = '<div class="form-group row">'+
                        '<div class="col-5">'+
                            '<input type="text" class="form-control" name="nama_lampiran[]" placeholder="Nama Lampiran" required>'+
                        '</div>'+
                        '<div class="col-5">'+
                            '<input type="file" class="form-control" name="lampiran[]" required>'+
                        '</div>'+
                        '<div class="col">'+
                            '<button type="button" class="btn btn-warning del-lampiran"><i class="fas fa-trash fa-fw"></i></button>'+
                        '</div>'+
                    '</div>';
                    
        $('.lampiran').append(lampiran);
    });
    //del lampiran
    $('body').on('click', '.del-lampiran', function() {
        $(this).closest('.row').remove();
    });
    //fungsi pembayaran
    $('body').on('keyup change', '.calc, input[name="pembayaran"]', function() {
        bayar_hpp = $('input[name="bayar_hpp"]');
        bayar_biad = $('input[name="bayar_biad"]');
        bayar = $('input[name="pembayaran"]');
        persen = $('select[name="persen"]').children("option:selected").val();

        biad = (persen/100)*bayar_hpp.val();
        bayar_biad.val(biad);
        bayar.val(parseFloat(bayar_hpp.val()) + parseFloat(biad));

        /*
        bayar = $('input[name="pembayaran"]');
        saldo_akhir = $('input[name="saldo_hutang_akhir"]');
        hak_kreditur = $('input[name="hak_kreditur"]');

        saldo_adm = parseFloat($('input[name="saldo_adm"]').val());
        saldo_bayar = parseFloat(bayar.val());
        nilai_pajak = parseFloat($('input[name="nilai_pajak"]').val());

        bayar_hpp.val((saldo_bayar*10)/11);
        bayar_biad.val((saldo_bayar*1)/11);
        hak_kreditur.val(saldo_bayar-nilai_pajak);
        saldo_akhir.val(saldo_adm-saldo_bayar);
        */
    });
});