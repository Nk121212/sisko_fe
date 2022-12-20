$(document).ready(function(){

    $('.divExist').hide();
    $('.divNotExist').hide();

    $('#tax_type').change(function(){
        //alert($(this).val());
        var tax_type = $(this).val();
        var element = $('select#tax_type').find('option:selected'); 
        var tax_type = element.attr("id-tax"); 
        
        $('select#service').html("");
    
        $.ajax({
            url: url+'get/service/'+tax_type,
            startTime: performance.now(),
            type: 'POST',
            dataType: 'json',
            success: function (res) {
                console.log(res);
                if(res.code=="200"){
                $('select#service').append('<option value="" disabled selected>Pelayanan</option>');
                $.each(res.data.sevice_type, function(k, v) {
                    //console.log(k);
                    //console.log(v.vmst_name);
                    $('select#service').append('<option value="'+v.vmst_id+'">'+v.vmst_name+'</option>');
    
                });
                }
    
            },
            cache: false,
            contentType: false,
            processData: false
        });
    
    })

    $("#detailPelayanan").on('shown.bs.modal', function (e) {

        $('.divPenerimaan').hide();
        $('.divAcara').hide();
        $('.divSppt').hide();
        $('.divSknjop').hide();
        $('.divSptpd').hide();
        $('.divSspd').hide();
        $('.divSSPDKB').hide();
        $('.divKeberatan').hide();
        $('.divPengurangan').hide();
        

        var id_detail = $(e.relatedTarget).data('detail');
        var tax_code = $(e.relatedTarget).data('tax');
        var area_code = $(e.relatedTarget).data('area');
        var param_send = $(e.relatedTarget).data('param');

        $("a#goto_lapor_ulang").attr("href", param_send);

        //alert(tax_code);

        $.post(url+"get/detail/history",
        {
            id: id_detail,
            tax_code: tax_code,
            area_code: area_code
            //city: "Duckburg"
        },
        function(data){
            //alert("Data: " + data + "\nStatus: " + status);
            console.log(data);
            if(data.code == '404'){

                $('.divExist').hide();
                $('.divNotExist').show();

            }else{

                //$('#goto_lapor_ulang').show();

                if(data.data.CPM_STATUS_NAME.toLowerCase() == 'ditolak'){
                    $('#goto_lapor_ulang').show();
                }else{
                    $('#goto_lapor_ulang').hide();
                }

                $('.divExist').show();
                $('.divNotExist').hide();

                //var arrTextBtn = ['Diproses', 'Selesai', 'Ditolak'];
                var arrClassBtn = ['secondary', 'success', 'danger'];

                var no = 0;
                $.each(data.data, function(k, v) {

                    $('#'+k+'').html("");

                    if(k == 'VM_SERVICE_STATUS'){
                        $('#'+k+'').append('<button class="btn btn-sm btn-'+arrClassBtn[v-1]+' rounded-pill">'+data.data.VM_SERVICE_STATUS_NAME+'</button>');
                    }else{
                        $('#'+k+'').append(v);
                    }

                    no++;

                });

                if(data.data.TAX_CODE == '0001'){

                    data.data.urlPenerimaan == "" || data.data.urlPenerimaan === null ? $('.divPenerimaan').hide() : $('.divPenerimaan').show();
                    data.data.SSPD == "" || data.data.SSPD === null ? $('.divSspd').hide() : $('.divSspd').show();
                    data.data.SSPDKB == "" || data.data.SSPDKB === null ? $('.divSSPDKB').hide() : $('.divSSPDKB').show();
                    // $('.divPenerimaan').show();
                    // $('.divSspd').show();
                    // $('.divSSPDKB').show();

                    $('#penerimaan').attr("href", (data.data.urlPenerimaan == "" || data.data.urlPenerimaan === null ? null : data.data.urlPenerimaan));
                    $('#sspd').attr("href", (data.data.SSPD == "" || data.data.SSPD === null ? null : data.data.SSPD));
                    $('#sspdkb').attr("href", (data.data.SSPDKB == "" || data.data.SSPDKB === null ? null : data.data.SSPDKB));

                    $('#labelByTax').text('NPWPD');
                    $('#VM_SERVICE_NUMBER').html("");
                    $('#VM_SERVICE_NUMBER').append(data.data.VM_SERVICE_DETAIL.wpNPWP);

                }else if(data.data.TAX_CODE == '0002'){

                    data.data.urlPenerimaan == "" || data.data.urlPenerimaan === null ? $('.divPenerimaan').hide() : $('.divPenerimaan').show();
                    data.data.urlBerita == "" || data.data.urlBerita === null ? $('.divAcara').hide() : $('.divAcara').show();
                    data.data.urlCetakSppt == "" || data.data.urlCetakSppt === null ? $('.divSppt').hide() : $('.divSppt').show();
                    data.data.urlCetakSKNJOP == "" || data.data.urlCetakSKNJOP === null ? $('.divSknjop').hide() : $('.divSknjop').show();
                    data.data.urlCetakKeberatan == "" || data.data.urlCetakKeberatan === null ? $('.divKeberatan').hide() : $('.divKeberatan').show();
                    data.data.urlCetakPengurangan == "" || data.data.urlCetakPengurangan === null ? $('.divPengurangan').hide() : $('.divPengurangan').show();
                    
                    // $('.divPenerimaan').show();
                    // $('.divAcara').show();
                    // $('.divSppt').show();
                    // $('.divSknjop').show();
                    // $('.divKeberatan').show();
                    // $('.divPengurangan').show();

                    $('#penerimaan').attr("href", (data.data.urlPenerimaan == "" || data.data.urlPenerimaan === null ? null : data.data.urlPenerimaan));
                    $('#berita').attr("href", (data.data.urlBerita == "" || data.data.urlBerita === null ? null : data.data.urlBerita));
                    $('#esppt').attr("href", (data.data.urlCetakSppt == "" || data.data.urlCetakSppt === null ? null : data.data.urlCetakSppt));
                    $('#esknjop').attr("href", (data.data.urlCetakSKNJOP == "" || data.data.urlCetakSKNJOP === null ? null : data.data.urlCetakSKNJOP));
                    $('#keberatan').attr("href", (data.data.urlCetakKeberatan == "" || data.data.urlCetakKeberatan === null ? null : data.data.urlCetakKeberatan));
                    $('#pengurangan').attr("href", (data.data.urlCetakPengurangan == "" || data.data.urlCetakPengurangan === null ? null : data.data.urlCetakPengurangan));
                    $('#labelByTax').text('NOP');

                }else if(data.data.TAX_CODE == '0003'){

                    data.data.SPTPD == "" || data.data.SPTPD === null ? $('.divSspd').hide() : $('.divSspd').show();
                    data.data.SSPD == "" || data.data.SSPD === null ? $('.divSspd').hide() : $('.divSspd').show();

                    // $('.divSspd').show();
                    // $('.divSptpd').show();

                    $('#sptpd').attr("href", (data.data.SPTPD == "" || data.data.SPTPD === null ? null : data.data.SPTPD));
                    $('#sspd').attr("href", (data.data.SSPD == "" || data.data.SSPD === null ? null : data.data.SSPD));
                    $('#labelByTax').text('NOP');

                }

            }
            

        });
   });

})