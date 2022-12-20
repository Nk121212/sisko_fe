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

$(document).ready(function() {

    //$("select.propinsi").val('64').trigger('change');
    //$("select[name='kotaKab']").val('6471').trigger('change');

    onLoadSelect2();

    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        //alert('ganti tab');
        changeSelect();
    })

    function changeSelect() {
        $("select.select2").select2({
            tags: true
        })
    }

    function onLoadSelect2() {
        $("select.select2").select2({
            tags: true
        })
    }

    show_news();
    status_layanan();

    $(".propinsi").change(function(){

        var kode_provinsi = $(this).val();
        var idKota = $(this).attr('id-kota');

        //alert(kode_provinsi);

        getKota(idKota, kode_provinsi);

    })

    function getKota(id_kota, kode_provinsi){

        $('#'+id_kota+'').html("");

        $.ajax({
            url: url+'get/area/'+kode_provinsi,
            startTime: performance.now(),
            type: 'POST',
            data: {},
            success: function (data) {

                $('#'+id_kota+'').append('<option value="" disabled selected>Kota/Kabupaten</option>');

                $.each(data.data.area, function(k, v) {
                    $('#'+id_kota+'').append('<option kode_prov="'+v.vma_prov_code+'" value="'+v.vma_code+'">'+v.vma_name+'</option>');
                });

                //$('#'+id_kota+'').val('6471').trigger('change');


            },
            cache: false,
            contentType: false,
            processData: false
        });

    }

    $('#formInquiryPbb').submit(function(e){

        $('div#fetchDiv').hide();
        $('div#notFoundDiv').hide();

        e.preventDefault();

        if ($('#formInquiryPbb')[0].checkValidity() === false) {
            e.stopPropagation();
        } else {
            //do ajax submition here
            var formData = new FormData(this);
            $.ajax({
                url: url+'cek_tagihan/pbb',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                success: function (data) {

                    console.log(data.code);

                    if(data.code == '200'){

                        $('div#fetchDiv').show();

                        $('#pbbstatusText').text(data.data[0].statusText);
                        $('#pbbnopTahun').text(data.data[0].nop+' - '+data.data[0].tahun);
                        $('#pbbnama').text(data.data[0].nama);
                        $('#pbbalamat').text(data.data[0].alamat);
                        $('#pbbbumi').text(data.data[0].bumi+ ' m');
                        $('#pbbbangunan').text(data.data[0].bangunan+ ' m');
                        $('#pbbdenda').text('Rp. '+parseInt(data.data[0].denda).toLocaleString()+',-');
                        $('#pbbtagihan').text('Rp. '+parseInt(data.data[0].tagihan).toLocaleString()+',-');
                        $('#pbbtotalTagihan').text('Rp. '+parseInt(data.data[0].totalTagihan).toLocaleString()+',-');
                        
                    }else{

                        $('div#notFoundDiv').show();

                    }
        
                },
                cache: false,
                contentType: false,
                processData: false
            });

            $("#modalInquiryPbb").modal("show");

        }

        $('#formInquiryPbb').addClass('was-validated');

    });

    $('#formInquiryBphtb').submit(function(e){

        $('div#fetchDiv').hide();
        $('div#notFoundDiv').hide();

        e.preventDefault();
        if ($('#formInquiryBphtb')[0].checkValidity() === false) {
            e.stopPropagation();
        } else {
            //do ajax submition here
            var formData = new FormData(this);
            $.ajax({
                url: url+'cek_tagihan/bphtb',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                success: function (data) {

                    console.log(data.code);

                    if(data.code == '200'){

                        $('div#fetchDiv').show();

                        $('#bphtbstatusText').text(data.data[0].statusText);
                        $('#bphtbnopTahun').text(data.data[0].nop);
                        $('#bphtbnama').text(data.data[0].nama);
                        $('#bphtbalamat').text(data.data[0].alamat);
                        $('#bphtbbumi').text(data.data[0].bumi+ ' m');
                        $('#bphtbbangunan').text(data.data[0].bangunan+ ' m');
                        $('#bphtbdenda').text('Rp. '+parseInt(data.data[0].denda).toLocaleString()+',-');
                        $('#bphtbtagihan').text('Rp. '+parseInt(data.data[0].tagihan).toLocaleString()+',-');
                        $('#bphtbtotalTagihan').text('Rp. '+parseInt(data.data[0].totalTagihan).toLocaleString()+',-');
                        
                    }else{

                        $('div#notFoundDiv').show();

                    }
        
                },
                cache: false,
                contentType: false,
                processData: false
            });

            $("#modalInquiryBphtb").modal("show");

        }

        $('#formInquiryBphtb').addClass('was-validated');

    });

    $('#formInquiryNinePajak').submit(function(e){

        $('div#fetchDiv').hide();
        $('div#notFoundDiv').hide();
        
        e.preventDefault();
        if ($('#formInquiryNinePajak')[0].checkValidity() === false) {
            e.stopPropagation();
        } else {
            //do ajax submition here
            var formData = new FormData(this);
            $.ajax({
                url: url+'cek_tagihan/ninePajak',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                success: function (data) {

                    console.log(data.code);

                    if(data.code == '200'){

                        console.log('data code 200');

                        $('div#fetchDiv').show();

                        $('#npjkstatusText').text(data.data[0].statusText);
                        $('#npjknopTahun').text(data.data[0].nop+' - '+data.data[0].tahun);
                        $('#npjknama').text(data.data[0].nama);
                        $('#npjkalamat').text(data.data[0].alamat);
                        //$('#npjkbumi').text(data.data[0].bumi+ ' m');
                        //$('#npjkbangunan').text(data.data[0].bangunan+ ' m');
                        $('#npjkdenda').text('Rp. '+parseInt(data.data[0].denda).toLocaleString()+',-');
                        $('#npjktagihan').text('Rp. '+parseInt(data.data[0].tagihan).toLocaleString()+',-');
                        $('#npjktotalTagihan').text('Rp. '+parseInt(data.data[0].totalTagihan).toLocaleString()+',-');
                        
                    }else{

                        console.log('data code != 200');
                        $('div#notFoundDiv').show();

                    }
        
                },
                cache: false,
                contentType: false,
                processData: false
            });

            $("#modalInquiryNinePajak").modal("show");

        }

        $('#modalInquiryNinePajak').addClass('was-validated');

    });

    function show_news(){

        $.ajax({
            url: url+'dashboard/news',
            startTime: performance.now(),
            type: 'POST',
            data: {},
            success: function (data) {
                //console.log(data);
                $.each(data, function( key, value ) {
                    //console.log(value[key].vmn_id);
                    //alert( key + ": " + value.vmn_id );
                    //$('#a').addClass('active');
                    var array = value.vmn_content.split(" ");
                    var text = [];

                    for (i=0;i<20;i++){
                        text[i] = array[i];
                    }

                    content = text.join(" ")+"...";
                    
                    if(key === 0){
                        $('div#load_news').append('<div class="carousel-item active"><img src="'+value.vmn_img+'" alt="..."><div class="carousel-caption d-none d-md-block"><h5>'+value.vmn_title+'</h5><p>'+content+'</p></div></div>');
                    }else{
                        $('div#load_news').append('<div class="carousel-item"><img src="'+value.vmn_img+'" alt="..."><div class="carousel-caption d-none d-md-block"><h5>'+value.vmn_title+'</h5><p>'+content+'</p></div></div>');
                    }
    
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });
    
    }

    function status_layanan(){

        $.ajax({
            url: url+'dashboard/layanan',
            startTime: performance.now(),
            type: 'POST',
            data: {},
            success: function (data) {
                //console.log(data);
                var iconCard = ["fa fa-3x fa-pencil-ruler", "fa fa-3x fa-times-circle", "fa fa-3x fa-clipboard-check"];

                var i = 0;
                $.each(data, function( key, value ) {
                    
                    $('#serviceCardDiv').append('<div class="col-md-3 col-12"><div class="card status"><div class="card-body px-3 py-4-5"><div class="row" style="margin-left: 22px;"><div class="col-md-4"><div class="stats-icon inProgress"><i class="'+iconCard[i]+'"></i></div></div><div class="col-md-8"><h6 class="text-muted font-semibold">'+key+'</h6><h6 class="font-extrabold mb-0">'+value+'</h6></div></div></div></div></div>');
                     i++;
    
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });
    
    }

});
