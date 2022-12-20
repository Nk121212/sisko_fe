$(document).ready(function(){

    $('#gif').hide();
    $('.filterNop').hide();
    $('.nopChild').hide();

    var tax_type = '0002'; //PBB ID
    
    $.ajax({
        url: url+'get/service/'+tax_type,
        startTime: performance.now(),
        type: 'POST',
        data: {},
        success: function (data) {
            //alert(data);
            $('#selectPelayanan').append('<option value="" disabled selected>Pelayanan</option>');
            $.each(data.data.sevice_type, function(k, v) {
                //alert();
                $('#selectPelayanan').append('<option value="'+v.vmst_id+'">'+v.vmst_name+'</option>');

            });

            var selectedAutoService = $('input#PelayananselectProfile').val();
            var nopAutoService = $('input#nopSelectedProfile').val();

            if(selectedAutoService !== "" && selectedAutoService !== null){
                $('#selectPelayanan').val(selectedAutoService).trigger('change');
            }

            if(nopAutoService !== "" && nopAutoService !== null){
                $('#nop').val(nopAutoService).trigger('change');
            }

            if(selectedAutoService == "0001"){ //op baru
                $('#continue').click();
            }

            //$('#selectPelayanan').append('<option value="888">Cetak E-SPPT</option>');
            //$('#selectPelayanan').append('<option value="999">Cetak E-SKNJOP</option>');

        },
        cache: false,
        contentType: false,
        processData: false
    });

    $('#selectPelayanan').change(function(){

        var curDate = new Date().getFullYear();

        $("div#load_form").html("");

        //console.log('NOP =>'+$("#nop").val());

        if($("#nop").val() == "" || $("#nop").val() === null){
            $("#nop").val("");
            //console.log('nop belum d set');
        }else{
            //console.log('nop sudah d set');
        }
        
        //$("#nop").val(null).trigger("change");
        $("#tahunPajak").val("");
        //alert($(this).val());
        var selectedVal = $(this).val();
        if(selectedVal == '0002' || selectedVal == '0003' || selectedVal == '0004' || selectedVal == '0005' || selectedVal == '0006' || selectedVal == '0007' || selectedVal == '0008' || selectedVal == '0009' || selectedVal == '0010' || selectedVal == '0888' || selectedVal == '0999'){
            $('.filterNop').show();
            if(selectedVal == '0003'){ //penggabungan
                $('.nopChild').show();
                $('.thnPajak').hide();
                $('select#tahunPajak').val(curDate).trigger('change');
            }else if(selectedVal !== '0999' && selectedVal !== '0888' && selectedVal !== '0007'){
                $('.nopChild').hide();
                $('.thnPajak').hide();
                $('select#tahunPajak').val(curDate).trigger('change');
            }else{
                $('.nopChild').hide();
                $('#nopChild').val("");
            }
        }else{
            $('.filterNop').hide();
            $('.nopChild').hide();
            $('#nopChild').val("");
        }
    })

    $('#continue').click(function(){
        $('div#load_form').html("");
        var selectedPelayanan = $('#selectPelayanan').val();
        var nop = $("#nop").val();

        if(selectedPelayanan !== "0999" && selectedPelayanan !== "0888" && selectedPelayanan !== "0007"){
            var tahunPajak = new Date().getFullYear();
        }else{
            var tahunPajak = $("#tahunPajak").val();
        }

        //alert(tahunPajak);
        
        var element = $('select#nop').find('option:selected'); 
        var area = element.attr("area_code"); 

        var nopChild = $('#nopChild').val();

        var params = selectedPelayanan+"_"+nop+"_"+tahunPajak+"_"+area+"_"+nopChild;
        
        if(selectedPelayanan === null){
            my_notif('error', 'Pelayanan Kosong', 'Pilih Pelayanan!');
            $('#selectPelayanan').focus();
        }else{
            if(selectedPelayanan == "0001"){ //op baru
                $('#load_form').load(url+"pelayanan/form/pbb/"+params);
            }else if(selectedPelayanan == "0003"){ //penggabungan
                if(nop == "" || nop === null){
                    my_notif('error', 'Nop Kosong', 'Pilih NOP !');
                }else{
                    if(nopChild == "" || nopChild === null){
                        my_notif('error', 'Nop Child Kosong', 'Pilih NOP Child!');
                    }else{
                        $('#load_form').load(url+"pelayanan/form/pbb/"+params);
                    }
                }
            }else if(selectedPelayanan == '0007'){
                if(nop == "" || nop === null){
                    my_notif('error', 'Nop Kosong', 'Pilih NOP !');
                }else{
                    if(tahunPajak == "" || tahunPajak === null){
                        my_notif('error', 'Tahun Pajak Kosong', 'Pilih Tahun Pajak!');
                    }else{
                        $('#load_form').load(url+"pelayanan/form/pbb/"+params);
                    }
                }
            }else{
                if(nop == "" || nop === null){
                    my_notif('error', 'Nop Kosong', 'Pilih NOP !');
                }else{
                    $('#load_form').load(url+"pelayanan/form/pbb/"+params);
                }
            }
        }
        
    })

    $('#nop').change(function(){

        //alert('nop  diubah');

        $('#nopChild').html("");
        var selectedNop = $(this).val();

        $.ajax({
            url: url+'get/nop',
            startTime: performance.now(),
            type: 'POST',
            data: {},
            success: function (data) {
                console.log(data);
                //alert(data);
                //$('#nopChild').append('<option value="" disabled selected>Pilih NOP Child</option>');

                if($("#selectPelayanan").val() == "0003"){ //jika penggabungan

                    $i=0;
                    $.each(data.data.profile_pajak, function(k, v) {
                        if(v.vmtm_nop == selectedNop){

                        }else{

                            $('#nopChild').append('<option value="'+v.vmtm_nop+'">'+v.vmtm_nop+'</option>');

                        }
                        $i++;
                    });

                    if($('#nopChildSelectedProfile').val() !== null && $('#nopChildSelectedProfile').val() !== ""){
                        var x = $('#nopChildSelectedProfile').val();
                        var spl = x.split('|');
                    }

                    $('#nopChild').val(null).trigger('change');

                    $('.test').select2({
                        multiple: true,
                        placeholder: "Pilih NOP Child",
                        allowClear: true
                    });

                    if($('#nopChildSelectedProfile').val() !== null && $('#nopChildSelectedProfile').val() !== ""){
                        var val = new Array();
                        for (let index = 0; index < spl.length; index++) {
                            const element = spl[index];
                            //console.log(element);
                            val[index] = element;
                        }

                        $('#nopChild').val(val).change();
                        $('#continue').click();
                    }

                }
    
            },
            cache: false,
            contentType: false,
            processData: false
        });
    })

})