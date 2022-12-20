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

    var myNop = $('#nop').val();
    var thnPajak = $('#tahunPajak').val();

    /*$.post(url+'get/draft/perubahan_data',
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
            
    });*/

})

$('#confirmDraft').click(function(){

    var myNop = $('#nop').val();
    var thnPajak = $('#tahunPajak').val();

    $.post(url+'get/draft/perubahan_data',
    {
        nop: myNop,
        tahun_pajak: thnPajak
    },
    function(data){
        //alert("Data: " + data + "\nStatus: " + status);
        console.log(data);
        $.each(data.data.perubahan_data, function(k, v) {
            $('input[name="'+k+'"]').val(v);
        });

        var draftZnt = data.data.perubahan_data.znt;
        var draftJenisTanah = data.data.perubahan_data.jenisTanah;

        $("#znt").val(draftZnt).trigger("change");
        $("#jenisTanah").val(draftJenisTanah).trigger("change");
            
    });

})

$('#znt').change(function(){
    console.log($(this).val());
})

$('#jenisTanah').change(function(){
    console.log($(this).val());
})

$('form#FrmInsertPerubahanData').submit(function(e){

    var id_button = $(document.activeElement).attr("id");
    console.log('id button clicked '+id_button);

    e.preventDefault();

    /*if ($('form#FrmInsertMutasi')[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        
    }

    $('#FrmInsertMutasi').addClass('was-validated');*/
        
    var formData = new FormData(this);
    
    if(id_button == 'save'){

        $.ajax({
            url: url+'insert/perubahan_data',
            startTime: performance.now(),
            type: 'POST',
            data: formData,
            enctype: 'multipart/form-data',
            beforeSend: function() {

                beforeSendLoading(2);   
                
            },
            success: function (data) {

                if(data.code == '200'){

                    var icon = "success";
                    var title = 'Insert Perubahan Data';
                    var message = data.message;
                    var redirect = 'history';

                }else if(data.code == '400'){

                    var icon = "error";
                    var title = 'Insert Perubahan Data';
                    var message = data.message;
                    var redirect = '';

                }

                loadSwal(icon, title, message, redirect);

            },
            cache: false,
            contentType: false,
            processData: false
        });

    }else if(id_button == 'draft'){

        $.ajax({
            url: url+'insert/perubahan_data/draft',
            startTime: performance.now(),
            type: 'POST',
            data: formData,
            enctype: 'multipart/form-data',
            beforeSend: function() {

                beforeSendLoading(2);   
                
            },
            success: function (data) {

                console.log(data);
                //return false;

                var icon = (data.code == '201') ? "success" : "error";
                var title = 'Insert Perubahan Data';
                var message = data.message;
                var redirect = 'history';

                loadSwal(icon, title, message, redirect);

            },
            cache: false,
            contentType: false,
            processData: false
        });

    }
    
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
    