$(document).ready(function(){

    $('.select2').select2();
    
    $('#gif').hide();
    $('.filterNop').hide();
    $('.nopChild').hide();
    $('.divKodeBayar').hide();


    /*array = ['1', '2'];
    text = ['SSPD BARU', 'KURANG BAYAR'];

    for (let index = 0; index < array.length; index++) {
     
        const element = array[index];
        const optText = text[index];
        //console.log(element);
        $('#selectPelayanan').append('<option value="'+element+'">'+optText+'</option>');
        
    }*/

    var tax_type = '0001'; //9pajak ID
    
    $.ajax({
        url: url+'get/service/'+tax_type,
        startTime: performance.now(),
        type: 'POST',
        data: {},
        success: function (data) {
           // console.log(data);
            $.each(data.data.sevice_type, function(k, v) {
                $('#selectPelayanan').append('<option value="'+v.vmst_id+'">'+v.vmst_name+'</option>');
            });

            //var selectedAutoService = $('input#PelayananselectProfile').val();
            //console.log(selectedAutoService);
            
            //$('#selectPelayanan').val(selectedAutoService).trigger('change');

        },
        cache: false,
        contentType: false,
        processData: false
    });

    $('#selectPelayanan').change(function(){

        $("div#load_form").html("");
        
        var selectedVal = $(this).val();

        if(selectedVal == '1'){ //sspd baru
            $('#kodeBayar').val("");
            $('.divKodeBayar').hide();
        }else if(selectedVal == '2'){ //kurang bayar
            $('.divKodeBayar').show();
        }

    })

    $('#continue').click(function(){

        $('div#load_form').html("");

        var selectedPelayanan = $('#selectPelayanan').val();
        var params = selectedPelayanan;
        
        if(selectedPelayanan === null){
            $('#selectPelayanan').focus();
        }else if(selectedPelayanan == '1' && $("#prov").val() == "" || $("#prov").val() === null){
            $('#prov').focus();
        }else if(selectedPelayanan == '1' && $("#kota").val() === null || $("#kota").val() == ""){
            $('#kota').focus();
        }else if(selectedPelayanan == '2' && selectedPelayanan === null){
            $('#selectPelayanan').focus();
        }else if(selectedPelayanan == '2' && $("#prov").val() == "" || $("#prov").val() === null){
            $('#prov').focus();
        }else if(selectedPelayanan == '2' && $("#kota").val() === null || $("#kota").val() == ""){
            $('#kota').focus();
        }else if(selectedPelayanan == '2' && $("#kodeBayar").val() === null || selectedPelayanan == '2' && $("#kodeBayar").val() == ""){
			//console.log('ganggu');
            $('#kodeBayar').focus();
        }else{

            var areaSelected = $('#kota').val();

            if(selectedPelayanan == '2'){

                beforeSendLoading(2); 

                $.post(url+"cek/kode_bayar",
                {
                    area_code: areaSelected,
                    kodeBayar: $('#kodeBayar').val()
                },
                function(data){
    
                    //jnsPerolehan
                    console.log(data);
                    //$('#jnsPerolehan').append('<option value="" disabled selected>Jenis Perolehan</option>');
                    if(data.code == '200'){

                        loadSwal('success', 'Cek Kode Bayar', 'Kode Bayar Ditemukan', '');

                        $('#load_form').load(url+"pelayanan/form/bphtb/"+params);
    
                        $.each(data.data, function(k, v) {
                            $('input[id-fetch="'+k+'"]').val(v).trigger('change');
                            $('select[id-fetch="'+k+'"]').val(v).trigger('change');
                            $('textarea[id-fetch="'+k+'"]').text(v).trigger('change');
                        });
    
                    }else{
                        $("div#load_form").html("");
                        loadSwal('error', 'Cek Kode Bayar', 'Kode Bayar Tidak Ditemukan', '');
                        $('#kodeBayar').focus();
                    }
    
                    //getPersyaratanUpload();
    
                });

                
            }else{
                $('#load_form').load(url+"pelayanan/form/bphtb/"+params);
            }
        }
        
    })

    $('#prov').change(function(){
        
        $("#kota").html("");

        var prov = $(this).val();

        $.post(url+"get/area/"+prov,
        {
            //name: "Donald Duck",
            //city: "Duckburg"
        },
        function(data){

            var selectedAutoArea = $('input#areaSelectedProfile').val();

            $('#kota').append('<option value="" disabled selected>Pilih Kota</option>');

            $.each(data.data.area, function(k, v) {
                $('#kota').append('<option value="'+v.vma_code+'">'+v.vma_name+'</option>');
            });

            $('#kota').val(selectedAutoArea).trigger('change');
            $('#continue').click();

        });
    })

})