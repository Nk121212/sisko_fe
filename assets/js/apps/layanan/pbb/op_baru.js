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

let map;
let markers = [];
function grabMyPosition() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(centerMe);
    } else {
        alert("You don't support this");
    }
    }
    function centerMe(position) {
    var coords = new google.maps.LatLng(
        position.coords.latitude,
        position.coords.longitude
    );

    map.setCenter(coords);
    // or
    map.panTo(coords);
    }
    function codeAddress(address) {
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == 'OK') {
        map.setCenter(results[0].geometry.location);
        // var marker = new google.maps.Marker({
        //     map: map,
        //     position: results[0].geometry.location
        // });
        } else {
        alert('Geocode was not successful for the following reason: ' + status);
        }
    });
    }
    function setInput(longLat) {
    console.log(longLat);
    // alert(longLat.lat);
    $('#long').val(longLat.lng);
    $('#lat').val(longLat.lat);
    }
    // Adds a marker to the map and push to the array.
    function addMarker(location) {
        console.log(location);

        const marker = new google.maps.Marker({
            position: location,
            map: map,
        });
        markers.push(marker);
    }

    // Sets the map on all markers in the array.
    function setMapOnAll(map) {
    for (let i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
    setMapOnAll(null);
    }

    // Shows any markers currently in the array.
    function showMarkers() {
    setMapOnAll(map);
    }

    // Deletes all markers in the array by removing references to them.
    function deleteMarkers() {
    clearMarkers();
    markers = [];
    }

$(document).ready(function(){

    var kotaKabOp;
    var kecamatanOp;
    var kelurahanOp;

    var kotaKabWp;
    var kecamatanWp;
    var kelurahanWp;

    var znt;
    var jenisTanah;

    var tahunPajak = new Date().getFullYear();

    $('.up').change(function(){

        //console.log($('select#npwpd').val());

        if($('select#kotaKabOp').val() === null){
            alert('Silakan Pilih Kota / Kabupaten!');
            $('select#kotaKabOp').focus();
            $(this).val("");
            return false;
        }

        var id = $(this).attr("data-id");
        //alert(id);

        var file_data = $("#upload_"+id)[0].files[0]; // Getting the properties of file from file field
        console.log(file_data);
        var form_data = new FormData(); // Creating object of FormData class

        form_data.append("upload", file_data) // Appending parameter named file with properties of file_field to form_data

        var area = $('select#kotaKabOp').val(); 
        //var area = element.attr("area_code"); 

        form_data.append("area_code", area);

        $.ajax({
            url: url+'upload/berkas/pbb/op_baru',
            startTime: performance.now(),
            type: 'POST',
            data: form_data,
            enctype: 'multipart/form-data',
            beforeSend: function() {
                
            },
            success: function (data) {

                console.log(data);
                $('input.'+id).val(id+','+data.data);
                if(data.code == '201'){
                    $('div.icon_upload_'+id).html('<span class="input-group-text"><i class="fa fa-check success_upload_icon padding_upload_icon"></i></span>');
                }else{
                    $('div.icon_upload_'+id).html('<span class="input-group-text" data-toggle="tooltip" data-placement="top" title="'+data.message+'"><i class="fa fa-times failed_upload_icon padding_upload_icon"></i></span>');
                }


            },
            cache: false,
            contentType: false,
            processData: false
        });

    })

    var vm_id_draft = $('input#vm_id').val();

    if(vm_id_draft == null || vm_id_draft == ""){

    }else{

        $('#vmIdService').val(vm_id_draft);

        $.post(url+"get/draft/by_vm",
        {
            vm_id: vm_id_draft
        },
        function(data){

            console.log(data.data.draft[0]);

            var response_detail = JSON.parse(data.data.draft[0].VM_SERVICE_DETAIL);
            var draftAttahcment = JSON.parse(data.data.draft[0].VM_ATTACHMENT);

            $('textarea[name="alamatOp"]').val(response_detail.alamatOp);
            $('input[name="rtOp"]').val(response_detail.rtOp);
            $('input[name="rwOp"]').val(response_detail.rwOp);

            tahunPajak = (data.data.draft[0].VM_SERVICE_YEAR == null || data.data.draft[0].VM_SERVICE_YEAR == "") ? new Date().getFullYear() : data.data.draft[0].VM_SERVICE_YEAR;

            kotaKabOp = response_detail.kotaKabOp;
            kecamatanOp = response_detail.kecamatanOp;
            kelurahanOp = response_detail.kelurahanOp;
            znt = response_detail.znt;
            jenisTanah = response_detail.jenisTanah;

            $('textarea[name="alamatWp"]').val(response_detail.alamatWp);
            $('input[name="noKtp"]').val(response_detail.noKtp);
            $('input[name="namaWp"]').val(response_detail.namaWp);
            $('input[name="rtWp"]').val(response_detail.rtWp);
            $('input[name="rwWp"]').val(response_detail.rwWp);
            $('input[name="kodeP"]').val(response_detail.kodeP);
            $('input[name="noHp"]').val(response_detail.noHp);

            $('select[name="pekerjaan"]').val(response_detail.pekerjaan);
            $('select[name="statKep"]').val(response_detail.statKep);
            

            kotaKabWp = response_detail.kotaKabWp;
            kecamatanWp = response_detail.kecamatanWp;
            kelurahanWp = response_detail.kelurahanWp;

            $('select[name="propinsiOp"]').val(response_detail.propinsiOp).trigger('change');
            $('select[name="propinsiWp"]').val(response_detail.propinsiWp).trigger('change');

            $('input[name="luasTanah"]').val(response_detail.luasTanah);
            $('input#long').val(response_detail.long);
            $('input#lat').val(response_detail.lat);
            $('input#jumlahBangunan').val(response_detail.jmlBangunan).trigger('keyup');

            $.each(draftAttahcment, function(k, v) {
                //console.log(v.doc);
                //console.log(v.source);
                if(v.source == "" || v.source == null){

                }else{
                    $('input.'+v.doc).val(v.doc+','+v.source);
                    $('div.icon_upload_'+v.doc).append('<a href="'+v.source+'" target="_blank"><span class="input-group-text"><i class="fa fa-eye success_upload_icon padding_upload_icon"></i></span></a>');
                }
                
            });
            
            

            var locByDraft = {lat: response_detail.lat === null ? "" : parseFloat(response_detail.lat), lng: response_detail.long  === null ? "" : parseFloat(response_detail.long)};
            console.log(locByDraft);
            addMarker(locByDraft);


        });

    }

    $('#propinsiOp').change(function(){
        //alert($(this).val());
        var kode_provinsi = $(this).val();
        
        $('#kotaKabOp').html("");
        $('#kotaKabOp').trigger('change');
    
        $.ajax({
            url: url+'get/area/'+kode_provinsi,
            startTime: performance.now(),
            type: 'POST',
            data: {},
            success: function (data) {
    
                $('#kotaKabOp').append('<option value="" disabled selected>Pilih Kota/Kab</option>');
                $.each(data.data.area, function(k, v) {
                    /// do stuff
                    //console.log(v.vma_name);
                    $('#kotaKabOp').append('<option kode_prov="'+v.vma_prov_code+'" value="'+v.vma_code+'">'+v.vma_name+'</option>');
    
                });
    
                console.log('kotaOp' + kotaKabOp);
    
                if(kotaKabOp instanceof Node){
    
                }else{
                    $('#kotaKabOp').val(kotaKabOp).trigger("change");
                }
    
    
            },
            cache: false,
            contentType: false,
            processData: false
        });
    
    })
    
    $('#kotaKabOp').change(function(){
        //alert($(this).val());
    
        $('#jenisTanah').html("");
        $('#kecamatanOp').html("");
        $('#kecamatanOp').trigger('change');
    
        var kode_area = $(this).val();
    
        //console.log(kode_area);
        
        if(kode_area === null){
    
        }else{
    
            $.post(url+"get/jenis_tanah",
            {
                area_code: kode_area
            },
            function(data){
                console.log(data);
                if(data.code == '400'){
    
                    $('#jenisTanah').append('<option value="" disabled selected>Pilih Jenis Tanah</option>');
    
                }else{
    
                    $.each(data.data.jenisTanah, function(k, v) {
                        $('#jenisTanah').append('<option value="'+v.CPM_OT_JENIS+'">'+v.CPM_OT_JENIS_INFO+'</option>');
                    });
    
                    if(kotaKabOp instanceof Node){
    
                    }else{
                        $('#jenisTanah').val(jenisTanah).trigger("change");
                    }
    
                }
                
            });
    
        }
    
        $.ajax({
            url: url+'get/kecamatan/'+kode_area,
            startTime: performance.now(),
            type: 'POST',
            data: {},
            success: function (data) {
    
                //console.log(data);
                if(data.code == '200'){
    
                    $('#kecamatanOp').append('<option value="" disabled selected>Pilih Kecamatan</option>');
    
                    $.each(data.data.kecamatan, function(k, v) {
                        /// do stuff
                        //console.log(v.vma_name);
                        $('#kecamatanOp').append('<option value="'+v.CPC_TKC_ID+'">'+v.CPC_TKC_KECAMATAN+'</option>');
        
                    });
        
                    if(kecamatanOp instanceof Node){
                        
                    }else{
                        $('#kecamatanOp').val(kecamatanOp).trigger("change");
                    }
    
                }
    
            },
            cache: false,
            contentType: false,
            processData: false
        });
    
    })
    
    $('#kecamatanOp').change(function(){
        //alert($(this).val());
        var kode_kecamatan = $(this).val();
        $('#kelurahanOp').html("");
        $('#kelurahanOp').trigger('change');
    
        console.log('Area Code => '+$('#kotaKabOp').val());
    
        $.post(url+'get/kelurahan/'+kode_kecamatan,
        {
            area_code: $('#kotaKabOp').val(),
        },
        function(data){
    
            console.log(data);
    
            if(data.code == '200'){
    
                $('#kelurahanOp').append('<option value="" disabled selected>Pilih Kelurahan</option>');
    
                $.each(data.data.Kelurahan, function(k, v) {
                    /// do stuff
                    //console.log(v.vma_name);
                    $('#kelurahanOp').append('<option value="'+v.CPC_TKL_ID+'">'+v.CPC_TKL_KELURAHAN+'</option>');
        
                });
        
                if(kelurahanOp instanceof Node){
                    
                }else{
                    $('#kelurahanOp').val(kelurahanOp).trigger("change");
                }
    
            }
    
        });
    
    })
    
    $('#kelurahanOp').change(function(){

        //alert('kelurahan changed');
        console.log('znt => '+znt);
        
        var kodeArea = $('#kotaKabOp').val();
        var kodeKelurahan = $(this).val();
       // var tahunPajak = new Date().getFullYear();
       //alert('kode area => '+kodeArea);
       //alert('kode kelurahan => '+kodeKelurahan);
       //alert('tahun pajak => '+tahunPajak);
       //alert('znt => '+znt);
       
    
        getZnt(kodeArea, kodeKelurahan, tahunPajak, znt);
    
    })
    
    //====== get wp
    
    $('#propinsiWp').change(function(){
        //alert($(this).val());
        var kode_provinsi = $(this).val();
        var nama_provinsi = $("#propinsiWp option:selected").text();
    
        $('#propinsiWpNama').val(nama_provinsi);
        $('#kotaKabWp').html("");
    
        $.ajax({
            url: url+'get/area/'+kode_provinsi,
            startTime: performance.now(),
            type: 'POST',
            data: {},
            success: function (data) {
    
                $('#kotaKabWp').append('<option value="" disabled selected>Pilih Kota/Kab</option>');
                $.each(data.data.area, function(k, v) {
                    /// do stuff
                    //console.log(v.vma_name);
                    $('#kotaKabWp').append('<option kode_prov="'+v.vma_prov_code+'" value="'+v.vma_code+'">'+v.vma_name+'</option>');
    
                });
    
                if(kotaKabWp instanceof Node){
                    
                }else{
                    $('#kotaKabWp').val(kotaKabWp).trigger("change");
                }
    
            },
            cache: false,
            contentType: false,
            processData: false
        });
    
    })
    
    $('#kotaKabWp').change(function(){
        //alert($(this).val());
        var kode_area = $(this).val();
        var nama_kota = $("#kotaKabWp option:selected").text();
        
        $('#kotaKabWpNama').val(nama_kota);
        $('#kecamatanWp').html("");
    
        $.ajax({
            url: url+'get/kecamatan/'+kode_area,
            startTime: performance.now(),
            type: 'POST',
            data: {},
            success: function (data) {
    
                //console.log(data);
    
                $('#kecamatanWp').append('<option value="" disabled selected>Pilih Kecamatan</option>');
                $.each(data.data.kecamatan, function(k, v) {
                    /// do stuff
                    //console.log(v.vma_name);
                    $('#kecamatanWp').append('<option value="'+v.CPC_TKC_ID+'">'+v.CPC_TKC_KECAMATAN+'</option>');
    
                });
    
                if(kecamatanWp instanceof Node){
                    
                }else{
                    $('#kecamatanWp').val(kecamatanWp).trigger("change");
                }
    
            },
            cache: false,
            contentType: false,
            processData: false
        });
    
    })
    
    $('#kecamatanWp').change(function(){
        //alert($(this).val());
        var kode_kecamatan = $(this).val();
        var nama_kecamatan = $("#kecamatanWp option:selected").text();
        
        $('#kecamatanWpNama').val(nama_kecamatan);
        $('#kelurahanWp').html("");
    
        $.post(url+'get/kelurahan/'+kode_kecamatan,
        {
            area_code: $('#kotaKabWp').val(),
        },
        function(data){
            //console.log(data);
            $('#kelurahanWp').append('<option value="" disabled selected>Pilih Kelurahan</option>');
            $.each(data.data.Kelurahan, function(k, v) {
                /// do stuff
                //console.log(v.vma_name);
                //console.log('value ahay '+v);
                $('#kelurahanWp').append('<option value="'+v.CPC_TKL_ID+'">'+v.CPC_TKL_KELURAHAN+'</option>');
    
            });
    
            if(kelurahanWp instanceof Node){
                
            }else{
                $('#kelurahanWp').val(kelurahanWp).trigger("change");
            }
    
        });
    
    })
    
    $('#kelurahanWp').change(function(){
        var nama_kelurahan = $("#kelurahanWp option:selected").text();
        //alert(nama_kelurahan);
        $('#kelurahanWpNama').val(nama_kelurahan);
    })
    
    $('form#frmRegOPBaru').submit(function(e){
    
        var id_button = $(document.activeElement).attr("id");
        //console.log('id button clicked '+id_button);
    
        e.preventDefault();
    
        var formData = new FormData(this);
    
        if(id_button == 'save'){
    
            isEmpty = false;
        
            $('input[type=file]:required').each(function() {
            if ($(this).val() === '')
                isEmpty = true;
            });
    
            if(isEmpty == true){
    
                loadSwal('error', 'Required Fields Empty', 'Mohon Isi Semua Mandatory Input !');
                return false;
    
            }
    
            $.ajax({
                url: url+'register/op/baru',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                enctype: 'multipart/form-data',
                beforeSend: function() {
    
                    //beforeSendLoading(2); 
                    
                },
                success: function (data) {
    
                    console.log(data);
    
                    if(data.code == '200'){
    
                        var icon = "success";
                        var title = 'Register OP Baru';
                        var message = data.message;
                        var redirect = 'pelayanan/pbb';
    
                    }else if(data.code == '400'){
    
                        var icon = "error";
                        var title = 'Register OP Baru';
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
                url: url+'register/op/baru/draft',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                enctype: 'multipart/form-data',
                beforeSend: function() {
    
                    beforeSendLoading(2); 
                    
                },
                success: function (data) {
    
                    console.log(data);
    
                    var icon = (data.code == '200') ? "success" : "error";
                    var title = 'Save Draft Register OP Baru';
                    var message = data.message;
                    var redirect = 'pelayanan/pbb';
    
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
        var area = $('select#kotaKabOp').val();
        
        if(area == "" || area === null){
            
            alert("silakan lengkapi data objek pajak lebih dulu");
            $('#alamatOp').focus();
            $('input[name="noKtp"]').val("");
    
        }else{
    
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
    
        }
    
    })

})

/*$('#confirmDraft').click(function(){

    $.ajax({
        url: url+'get/draft/op_baru',
        startTime: performance.now(),
        type: 'POST',
        data: {},
        success: function (data) {

            //console.log(data);

            $i=0;
            $.each(data.data.doc, function(k, v) {
                //console.log(k+'   =   '+v.title);
                $('#'+v.title+'').val(v.path);
                $i++;
            });

            $('textarea[name="alamatOp"]').val(data.data.op === null ? "" : data.data.op.alamatOp);
            $('input[name="rtOp"]').val(data.data.op === null ? "" : data.data.op.rtOp);
            $('input[name="rwOp"]').val(data.data.op === null ? "" : data.data.op.rwOp);

            kotaKabOp = data.data.op === null ? "" : data.data.op.kotaKabOp;
            kecamatanOp = data.data.op === null ? "" : data.data.op.kecamatanOp;
            kelurahanOp = data.data.op === null ? "" : data.data.op.kelurahanOp;
            znt = data.data.op === null ? "" : data.data.op.znt;
            jenisTanah = data.data.op === null ? "" : data.data.op.jenisTanah;

            $('textarea[name="alamatWp"]').val((data.data.wp == null) ? "" : data.data.wp.alamatWp);
            $('input[name="noKtp"]').val((data.data.wp == null) ? "" : data.data.wp.noKtp);
            $('input[name="namaWp"]').val((data.data.wp == null) ? "" : data.data.wp.namaWp);
            $('input[name="rtWp"]').val((data.data.wp == null) ? "" : data.data.wp.rtWp);
            $('input[name="rwWp"]').val((data.data.wp == null) ? "" : data.data.wp.rwWp);
            $('input[name="kodeP"]').val((data.data.wp == null) ? "" : data.data.wp.kodeP);
            $('input[name="noHp"]').val((data.data.wp == null) ? "" : data.data.wp.noHp);

            $('select[name="pekerjaan"]').val((data.data.wp == null) ? "" : data.data.wp.pekerjaan);
            $('select[name="statKep"]').val((data.data.wp == null) ? "" : data.data.wp.statKep);
            

            kotaKabWp = (data.data.wp == null) ? "" : data.data.wp.kotaKabWp;
            kecamatanWp = (data.data.wp == null) ? "" : data.data.wp.kecamatanWp;
            kelurahanWp = (data.data.wp == null) ? "" : data.data.wp.kelurahanWp;

            $('select[name="propinsiOp"]').val(data.data.op === null ? "" : data.data.op.propinsiOp).trigger('change');
            $('select[name="propinsiWp"]').val(data.data.wp === null ? "" : data.data.wp.propinsiWp).trigger('change');

            $('input[name="luasTanah"]').val(data.data.op === null ? "" : data.data.op.luasTanah);
            $('input#long').val(data.data.op === null ? "" : data.data.op.long);
            $('input#lat').val(data.data.op === null ? "" : data.data.op.lat);
            $('input#jumlahBangunan').val(data.data.op === null ? "" : data.data.op.jmlBangunan).trigger('keyup');

            var locByDraft = {lat: data.data.op === null ? "" : parseFloat(data.data.op.lat), lng: data.data.op === null ? "" : parseFloat(data.data.op.long)};
            //console.log(locByDraft);
            addMarker(locByDraft);

        },
        cache: false,
        contentType: false,
        processData: false
    });

})*/

