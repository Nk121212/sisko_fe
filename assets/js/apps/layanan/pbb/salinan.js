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

    var nopSelected = $('#nop').val();
    var thnPajakSelected = $('#tahunPajak').val();

    $('#area_code').val(area);
    $('#nopForm').val(nopSelected);
    $('#thnPjkForm').val(thnPajakSelected);

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
    