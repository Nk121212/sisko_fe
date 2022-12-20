$(document).ready(function(){
    // list Tax Type
    $.post(url+"get/tax_type", null, 
        function(resp){

            if(resp.code == '200'){

                $('.tax_code').append("<option value=''>Pilih Tipe Pajak</option>");

                $.each(resp.data, function(k, v) {
                    $('.tax_code').append("<option value="+v.vmtt_code+">"+v.vmtt_type.toUpperCase()+"</option>"); 
                });

            } 

        }
    );

    // list area
    $.post(url+"get/area/user", null, 
        function(resp){

            if(resp.code == '200'){

                $('.area_code').append("<option value=''>Pilih Area</option>");

                $.each(resp.data.area, function(k, v) {
                    $('.area_code').append("<option value="+v.vma_code+">"+v.vma_name+"</option>"); 
                });

            } 

        }
    );

    // list app config
    $.post(url+"table/config_app", null, 
        function(resp){

            if(resp.data.length){

                $('.app_config').append("<option value=''>Pilih App Config</option>");

                $.each(resp.data, function(k,o) {
                    $('.app_config').append("<option value="+o.config+">"+o.name+"</option>"); 
                });

            } 

        }
    );

    // list kartudata
    $.post(url+"get/kartudata", null, 
        function(resp){

            if(resp.data.length){

                $('.kartudata').empty();

                $.each(resp.data, function(k,o) {
                    $('.kartudata').append("<option value="+o.vmk_id+">"+o.vmk_name+"</option>"); 
                });

            } 

        }
    );


    // mapping PATH
    $('form#frmaddMappingPath').submit(function(e){

        var id_button = $(document.activeElement).attr("id");
    
        e.preventDefault();
            
        var formData = new FormData(this);
        
            $.ajax({
                url: url+'insert/path',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {
    
                    beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    notifTableAjaxSuccess(data.code, 'tableMappingPath', 'Insert Path', data.message, "addMappingPath");
                    $('form#frmaddMappingPath')[0].reset();
    
                    /*if(data.code == '201'){
    
                        var icon = "success";
                        var title = 'Insert Path';
                        var message = data.message;
                        var redirect = 'path/list';
    
                    }else if(data.code == '400'){
    
                        var icon = "error";
                        var title = 'Insert Path';
                        var message = data.message;
                        var redirect = '';
    
                    }
    
                    loadSwal(icon, title, message, redirect);*/
    
                },
                cache: false,
                contentType: false,
                processData: false
            });
        
    })


    $('#tableMappingPath tbody').on('click', 'tr td a.del', function () {
        //var data = table.row( this ).data();
        var id = $(this).attr('id-path');

        Swal.fire({
        title: 'Yakin Hapus Path ini?',
        text: "Tindakan ini tidak dapat dibatalkan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus saja!',
        cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {

                $.post(url+"delete/path",
                    {
                        vmp_id: id
                    },
                    function(resp){

                        console.log(resp);
                        notifTableAjaxSuccess(resp.code, 'tableMappingPath', 'Hapus Path', resp.message);

                    }
                );
            }
        })

    });

    $(document).on("click", ".editMappingPathButton", function () {

        var id = $(this).data('id');

        $.post(url+"get/path/profile",
            {
                id: id
            },
            function(resp){

                console.log(resp.data.path);
                //return false;
                $.each(resp.data.path[0], function(k, v) {
                    //console.log(k);
                    //console.log(v);
                    $(".modal-body.emp #"+k+"").val(v);
                });

            }
        );

        $('#editMappingPath').modal('show');

    });

    $('form#frmeditMappingPath').submit(function(e){

        e.preventDefault();
            
        var formData = new FormData(this);

        $.ajax({
            url: url+'update/path',
            startTime: performance.now(),
            type: 'POST',
            data: formData,
            //enctype: 'multipart/form-data',
            beforeSend: function() {

                beforeSendLoading(2);   
                
            },
            success: function (data) {

                notifTableAjaxSuccess(data.code, 'tableMappingPath', 'Update Path', data.message, "editMappingPath");

                /*if(data.code == '200'){

                    var icon = "success";
                    var title = 'Update Path';
                    var message = data.message;
                    var redirect = 'path/list';

                }else if(data.code == '400'){

                    var icon = "error";
                    var title = 'Update Path';
                    var message = data.message;
                    var redirect = '';

                }

                loadSwal(icon, title, message, redirect);*/


            },
            cache: false,
            contentType: false,
            processData: false
        });

    });




    // mapping API
    $('form#frmaddMappingApi').submit(function(e){

        e.preventDefault();
 
        var formData = new FormData(this);

            $.ajax({
                url: url+'insert/api',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                dataType:'json',
                //enctype: 'multipart/form-data',
                beforeSend: function() {
    
                    beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    notifTableAjaxSuccess(data.code, 'tableMappingApi', 'Insert Api', data.message, "addMappingApi");
                    $('form#frmaddMappingApi')[0].reset();
    
                    if(data.code == '201'){
    
                        var icon = "success";
                        var title = 'Insert API';
                        var message = data.message;
                        var redirect = 'api/list';
    
                    }else if(data.code == '400'){
    
                        var icon = "error";
                        var title = 'Insert API';
                        var message = data.message;
                        var redirect = '';
    
                    }
    
                    loadSwal(icon, title, message, redirect);
    
                },
                cache: false,
                contentType: false,
                processData: false
            });
        
    })

        //var table = $('#tableArea').DataTable();

    $('#tableMappingApi tbody').on('click', 'tr td a.del', function () {
        //var data = table.row( this ).data();
        var id = $(this).attr('id-api');

        Swal.fire({
            title: 'Yakin Hapus API ini?',
            text: "Tindakan ini tidak dapat dibatalkan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {

                $.post(url+"delete/api",
                    {
                        vmma_id: id
                    },
                    function(resp){

                        notifTableAjaxSuccess(resp.code, 'tableMappingApi', 'Hapus API', resp.message);

                    }
                );
            }
        })

    });

    $(document).on("click", ".editMappingApiButton", function () {

        var id = $(this).data('id');

        $.post(url+"get/api/profile",
            {
                id: id
            },
            function(resp){

                var svcType = '';
                $.each(resp.data, function(k, v) {
                    $(".modal-body.emp #"+k).val(v);
                });
                $('.tax_code').trigger('change');
                setTimeout(function(){
                    if($(".edit.service_type").hasClass("select2-hidden-accessible")) {
                        $(".edit.service_type").select2('destroy')
                    }
                    $(".edit.service_type").val(resp.data.vmma_service_type.split(","));
                    /* $.each(resp.data.vmma_service_type.split(","), function(i,e){
                        console.log(e)
                        $(".edit.service_type option[value='" + e + "']").prop("selected", true);
                    }); */
                    $(".edit.service_type").trigger('change')
                    $(".edit.service_type").select2();
                },1000)
            }
        );

        $('#editMappingApi').modal('show');

    });

    $('form#frmeditMappingApi').submit(function(e){

        //var id_button = $(document.activeElement).attr("id");
        //console.log('id button clicked '+id_button);

        e.preventDefault();
            
        var formData = new FormData(this);

        $.ajax({
            url: url+'update/api',
            startTime: performance.now(),
            type: 'POST',
            data: formData,
            //enctype: 'multipart/form-data',
            beforeSend: function() {

                beforeSendLoading(2);   
                
            },
            success: function (data) {

                notifTableAjaxSuccess(data.code, 'tableMappingApi', 'Update Api', data.message, "editMappingApi");

                /*if(data.code == '200'){

                    var icon = "success";
                    var title = 'Update API';
                    var message = data.message;
                    var redirect = 'api/list';

                }else if(data.code == '400'){

                    var icon = "error";
                    var title = 'Update API';
                    var message = data.message;
                    var redirect = '';

                }

                loadSwal(icon, title, message, redirect);*/


            },
            cache: false,
            contentType: false,
            processData: false
        });

    })

    $(".select2").select2();
    $(".tax_code").on("change", function(){
        var frm = $(this).closest('form');
        var tn = $(this).find('option:selected').text();
        if($(this).val()=="") return false;
        frm.find(".service_type").select2({placeholder:'Loading '+tn+' service type...'})
        $.post(url+'get/servicetype/'+$(this).val(), null, function(res){
            frm.find(".service_type").empty();
            frm.find(".service_type").select2({placeholder:''})
            if(res.code == 200){
                $.each(res.data.service_type, function(k,obj){
                    frm.find(".service_type").append("<option value='"+obj.vmst_id+"'>"+obj.vmst_name+"</option>")
                });
            }
        });
    })


})