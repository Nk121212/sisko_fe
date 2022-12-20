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
$('#formProfil').submit(function(e){
    e.preventDefault();
        if ($('#formProfil')[0].checkValidity() === false) {
            e.stopPropagation();
        }else{
            $.ajax({
                url: url+'C_profil_pajak/getPbbProfil', 
                data: {nop: $("#nop").val(),
                    tahun: $("#tahun").val(),
                    tanggal: $("#tanggal").val(),
                    areaCode: $("#kotaKab").val()},
                type:"post",
                success: function(data){
                    alert(data);
                    if(data.toLowerCase() == 'verifikasi profil'){
                        location.reload();
                    }
                    //location.reload();
                }
            });
            
            $('#addProfil').modal('hide');
        }
        $('#formProfil').addClass('was-validated');
});
$('#propinsi').change(function(){
    var kode_provinsi = $(this).val();
    $('#kotaKab').html("");

    $.ajax({
        url: url+'get/area/'+kode_provinsi,
        startTime: performance.now(),
        type: 'POST',
        data: {},
        success: function (data) {

            $('#kotaKab').append('<option value="" disabled selected>Pilih Kota/Kab</option>');
            $.each(data.data.area, function(k, v) {
                $('#kotaKab').append('<option kode_prov="'+v.vma_prov_code+'" value="'+v.vma_code+'">'+v.vma_name+'</option>');

            });

        },
        cache: false,
        contentType: false,
        processData: false
    });

});
