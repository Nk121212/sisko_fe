$(document).ready(function(){

    $('.select2').select2();
    
    $('#gif').hide();
    $('.filterNop').hide();
    $('.nopChild').hide();

    var tax_type = '0003'; //9pajak ID
    
    $.ajax({
        url: url+'get/service/'+tax_type,
        startTime: performance.now(),
        type: 'POST',
        data: {},
        success: function (data) {
            console.log(data);
            //alert(data);
            //$('#selectPelayanan').append('<option value="" disabled selected>Pilih Pelayanan</option>');
            $.each(data.data.sevice_type, function(k, v) {
                //alert();
				if(v.vmst_id == '1' || v.vmst_id == '7'){
					
				}else{
					$('#selectPelayanan').append('<option value="'+v.vmst_id+'">'+v.vmst_name+'</option>');
                }
                
                var selectedAutoService = $('input#PelayananselectProfile').val();

                $('#selectPelayanan').val(selectedAutoService).trigger('change');

                if(selectedAutoService !== null || selectedAutoService !== ""){
                    $('#continue').click();
                }

            });

            //$('#selectPelayanan').append('<option value="888">Cetak E-SPPT</option>');
            //$('#selectPelayanan').append('<option value="999">Cetak E-SKNJOP</option>');

        },
        cache: false,
        contentType: false,
        processData: false
    });

    $('#selectPelayanan').change(function(){
        $("div#load_form").html("");
        $("#nop").val("");
        $("#tahunPajak").val("");
        //alert($(this).val());
        var selectedVal = $(this).val();
        if(selectedVal == '0002' || selectedVal == '0003' || selectedVal == '0004' || selectedVal == '0005' || selectedVal == '0007' || selectedVal == '0008' || selectedVal == '0009' || selectedVal == '0010' || selectedVal == '888' || selectedVal == '999'){
            $('.filterNop').show();
            if(selectedVal == '0003'){
                $('.nopChild').show();
            }else if(selectedVal == '999'){ //jika sknjop
                $('.thnPajak').hide();
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
        //var nop = $("#nop").val();
        //var tahunPajak = $("#tahunPajak").val();
        
        //var element = $('select#nop').find('option:selected'); 
        //var area = element.attr("area_code"); 

        //var nopChild = $('#nopChild').val();

        //var params = selectedPelayanan+"_"+nop+"_"+tahunPajak+"_"+area+"_"+nopChild;
        var params = selectedPelayanan;
        
        if(selectedPelayanan === null){
            $('#selectPelayanan').focus();
        }else{
            $('#load_form').load(url+"pelayanan/form/ninePajak/"+params);
        }
        
    })

    $('#nop').change(function(){

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

                $i=0;
                $.each(data.data.profile_pajak, function(k, v) {
                    if(v.vmtm_nop == selectedNop){

                    }else{

                        $('#nopChild').append('<option value="'+v.vmtm_nop+'">'+v.vmtm_nop+'</option>');

                    }
                    $i++;
                });

                $('#nopChild').val("");
                $('.select2').select2({
                    multiple: true,
                    placeholder: "Pilih NOP Child",
                    allowClear: true
                });
    
            },
            cache: false,
            contentType: false,
            processData: false
        });
    })

})