(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
})();

$(document).ready(function(){

    var element = $('select#nop').find('option:selected'); 
    var area = element.attr("area_code"); 

    var myNop = $('#nop').val();
    var thnPajak = $('#tahunPajak').val();

    $('#area_code').val(area);

    $.post(url+"get/jenis_tanah",
    {
        area_code: area,
        //city: "Duckburg"
    },
    function(data){
        console.log(data.data.jenisTanah);
        $.each(data.data.jenisTanah, function(k, v) {
            $('#jenisTanah').append('<option value="'+v.CPM_OT_JENIS+'">'+v.CPM_OT_JENIS_INFO+'</option>');

        });
    });

    $.post(url+"get/znt",
    {
        area_code: area,
        kode_kelurahan: $('#kelurahanOpVal').val(),
        tahun: $('#tahunPajak').val()
        //city: "Duckburg"
    },
    function(data){
        console.log(data);
        
        $.each(data.data.znt, function(k, v) {
            $('#znt').append('<option value="'+v.CPM_KODE_ZNT+'">'+v.CPM_NIR+'</option>');
        });

    });

    $.post(url+'get/draft/perubahan_data',
    {
        nop: myNop,
        tahun_pajak: thnPajak
        //city: "Duckburg"
    },
    function(data){
        
        if(!data || data === null || data == ""){

        }else{

            console.log(data);

            if(data.data.perubahan_data !== null){

                $('#default').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $('#default').modal('show');

            }else{

            }

        }
            
    });

})

$('#znt').change(function(){
    console.log($(this).val());
})

$('#jenisTanah').change(function(){
    console.log($(this).val());
})

$('#btnCekKtp').click(function(){

    //alert('abcd');

    var no_ktp = $('input[name="noKtp"]').val();
    var area = $('input#area_code').val();

    //alert(area);
    //alert(no_ktp);

    $.post(url+"pelayanan/pbb/cek_ktp",
    {
        no_ktp: no_ktp,
        area_code: area
        //city: "Duckburg"
    },
    function(data){
        
        var resp = JSON.parse(data);

        console.log(resp);

        if(resp.code == 200){

            console.log('datana = '+resp.data[0].noKtp);
            $('textarea[name="alamatWp"]').text(resp.data[0].alamat);
            $('input[name="namaWp"]').val(resp.data[0].nama);
            $('input[name="rtWp"]').val(resp.data[0].rt);
            $('input[name="rwWp"]').val(resp.data[0].rw);
            $('input[name="kodeP"]').val(resp.data[0].kodeP);
            $('input[name="noHp"]').val(resp.data[0].noHp);
            $('select[name="propinsiWp"]').val(resp.data[0].kodePropinsi).trigger('change');
            $('select[name="kotaKabWp"]').val(resp.data[0].kodeKotaKab).trigger('change');
            $('select[name="kecamatanWp"]').val(resp.data[0].kodeKec).trigger('change');
            $('select[name="kelurahanWp"]').val(resp.data[0].kodeKel).trigger('change');

        }else{

            alert('Data tidak ditemukan');
            
        }
        

    });

})
    