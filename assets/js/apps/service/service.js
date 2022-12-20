$(document).ready(function(){

    $.post(url+"get/tax_type",
        {
            //id: idUsers
        },
        function(resp){

            console.log(resp);
            //return false;
            if(resp.code == '200'){

                $('select#tax_code').append("<option value=''>Pilih Tipe Pajak</option>");
                $('select#vmp_tax_code').append("<option value=''>Pilih Tipe Pajak</option>");

                $.each(resp.data.tax_type, function(k, v) {
                    $('select#tax_code').append("<option value="+v.vmtt_code+">"+v.vmtt_type+"</option>"); 
                    $('select#vmp_tax_code').append("<option value="+v.vmtt_code+">"+v.vmtt_type+"</option>"); 
                });

            } 

        }
    );

    $('form#frmaddService').submit(function(e){

        //alert($(this).attr("class"));return false;

        var formTaxType = $(this).attr("class");

        if(formTaxType == "0002"){
            //var redir = "pbb";
            var tableName = "TableServicePbb";
        }else if(formTaxType == "0003"){
            //var redir = "ninePajak";
            var tableName = "TableServiceNinePajak";
        }else if(formTaxType == "0001"){
            //var redir = "bphtb";
            var tableName = "TableServiceBphtb";
        }

        //var redir = (formTaxType == "0002") ? 'pbb' : 'ninePajak';

        var id_button = $(document.activeElement).attr("id");
        //console.log('id button clicked '+id_button);
    
        e.preventDefault();
            
        var formData = new FormData(this);
        
    
            $.ajax({
                url: url+'insert/service/'+formTaxType,
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {
    
                    beforeSendLoading(2);   
                    
                },
                success: function (data) {
    
                    notifTableAjaxSuccess(data.code, tableName, 'Insert Service Type', data.message, "addService");
                    $('form#frmaddService')[0].reset();
    
                },
                cache: false,
                contentType: false,
                processData: false
            });
        
    })

        //var table = $('#tableArea').DataTable();

    $('#TableServiceNinePajak tbody').on('click', 'tr td a.del', function () {
        //var data = table.row( this ).data();
        var id = $(this).attr('id-service');

        Swal.fire({
        title: 'Yakin Hapus Service Type ini?',
        text: "Tindakan ini tidak dapat dibatalkan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus saja!',
        cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {

                $.post(url+"delete/service/0003",
                    {
                        vmst_id: id
                    },
                    function(resp){

                        console.log(resp);
                        notifTableAjaxSuccess(resp.code, 'TableServiceNinePajak', 'Hapus Service Type', resp.message);

                    }
                );
            }
        })

    });

    $('#TableServicePbb tbody').on('click', 'tr td a.del', function () {
        //var data = table.row( this ).data();
        var id = $(this).attr('id-service');

        Swal.fire({
        title: 'Yakin Hapus Service Type ini?',
        text: "Tindakan ini tidak dapat dibatalkan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus saja!',
        cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {

                $.post(url+"delete/service/0002",
                    {
                        vmst_id: id
                    },
                    function(resp){

                        console.log(resp);
                        notifTableAjaxSuccess(resp.code, 'TableServicePbb', 'Hapus Service Type', resp.message);

                    }
                );
            }
        })

    });

    $('#TableServiceBphtb tbody').on('click', 'tr td a.del', function () {
        //var data = table.row( this ).data();
        var id = $(this).attr('id-service');

        Swal.fire({
        title: 'Yakin Hapus Service Type ini?',
        text: "Tindakan ini tidak dapat dibatalkan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus saja!',
        cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {

                $.post(url+"delete/service/0001",
                    {
                        vmst_id: id
                    },
                    function(resp){

                        console.log(resp);
                        notifTableAjaxSuccess(resp.code, 'TableServiceBphtb', 'Hapus Service Type', resp.message);

                    }
                );
            }
        })

    });

    $(document).on("click", ".editServiceButton", function () {

        var id = $(this).data('id');
        var tax_type = $(this).data('taxtype');

        $.post(url+"get/service/profile/"+tax_type,
            {
                id: id
            },
            function(resp){

                console.log(resp.data);
                //return false;
                $.each(resp.data, function(k, v) {
                    //console.log(k);
                    //console.log(v);
                    $(".modal-body.est input#"+k+"").val(v);
                    $(".modal-body.est select#"+k+"").val(v);
                    //$(".modal-body.est textarea#"+k+"").text(v);
                });

            }
        );

        $('#editService').modal('show');

    });

    $('form#frmeditService').submit(function(e){

        //var id_button = $(document.activeElement).attr("id");
        //console.log('id button clicked '+id_button);

        var formTaxType = $(this).attr("class");

        if(formTaxType == "0002"){
            //var redir = "pbb";
            var tableName = "TableServicePbb";
        }else if(formTaxType == "0003"){
            //var redir = "ninePajak";
            var tableName = "TableServiceNinePajak";
        }else if(formTaxType == "0001"){
            //var redir = "bphtb";
            var tableName = "TableServiceBphtb";
        }

        e.preventDefault();
            
        var formData = new FormData(this);

        $.ajax({
            url: url+'update/service/'+formTaxType,
            startTime: performance.now(),
            type: 'POST',
            data: formData,
            //enctype: 'multipart/form-data',
            beforeSend: function() {

                beforeSendLoading(2);   
                
            },
            success: function (data) {

                notifTableAjaxSuccess(data.code, tableName, 'Update Service Type', data.message, "editService");


            },
            cache: false,
            contentType: false,
            processData: false
        });

    })


})