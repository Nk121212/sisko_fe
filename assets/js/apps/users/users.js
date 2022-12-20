$(document).ready(function(){

    $('form#frmAddUsers').submit(function(e){

        var id_button = $(document.activeElement).attr("id");
        console.log('id button clicked '+id_button);
    
        e.preventDefault();
            
        var formData = new FormData(this);
        
    
            $.ajax({
                url: url+'insert/users',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {
    
                    beforeSendLoading(2);   
                    
                },
                success: function (data) {
    
                    notifTableAjaxSuccess(data.code, 'tableUsers', 'Insert User', data.message, "addUsers");
                    $('form#frmAddUsers')[0].reset();
    
                },
                cache: false,
                contentType: false,
                processData: false
            });
        
    })

    $('form#frmEditUsers').submit(function(e){

        var id_button = $(document.activeElement).attr("id");
        console.log('id button clicked '+id_button);

        e.preventDefault();
            
        var formData = new FormData(this);

        $.ajax({
            url: url+'update/users',
            startTime: performance.now(),
            type: 'POST',
            data: formData,
            //enctype: 'multipart/form-data',
            beforeSend: function() {

                beforeSendLoading(2);   
                
            },
            success: function (data) {

                notifTableAjaxSuccess(data.code, 'tableUsers', 'Update User', data.message, "editUsers");


            },
            cache: false,
            contentType: false,
            processData: false
        });

    })

    $.post(url+"get/provinsi",
        {
            //id: idUsers
        },
        function(resp){

            //console.log(resp.data.province);
            if(resp.code == '200'){

                $('select#prov').append("<option value=''>Pilih Provinsi</option>");

                $.each(resp.data.province, function(k, v) {
                    $('select#prov').append("<option value="+v.vmp_code+">"+v.vmp_name+"</option>");  
                });

            } 

        }
    );

    $('select#prov').change(function(){

        var prov_kode = $(this).val();

        $.post(url+"get/area/"+prov_kode,
        {
            //id: idUsers
        },
        function(resp){

            //console.log(resp.data.province);
            if(resp.code == '200'){

                $('select#vmu_area_code').append("<option value=''>Pilih Area</option>");

                $.each(resp.data.area, function(k, v) {
                    $('select#vmu_area_code').append("<option prov-code="+v.vma_prov_code+" value="+v.vma_code+">"+v.vma_name+"</option>");  
                });

            } 

        })

    })

})