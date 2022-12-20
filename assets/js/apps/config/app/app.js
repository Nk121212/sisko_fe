$(document).ready(function(){

    $('form#frmaddConfigApp').submit(function(e){

        var id_button = $(document.activeElement).attr("id");
        //console.log('id button clicked '+id_button);
    
        e.preventDefault();
            
        var formData = new FormData(this);
        
    
            $.ajax({
                url: url+'insert/config/app',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {
    
                    beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    notifTableAjaxSuccess(data.code, 'TableAppConfig', 'Insert Config App', data.message, 'addConfigApp');
                    $('form#frmaddConfigApp')[0].reset();
    
                },
                cache: false,
                contentType: false,
                processData: false
            });
        
    })

        //var table = $('#tableArea').DataTable();

    $('#TableAppConfig tbody').on('click', 'tr td a.del', function () {
        //var data = table.row( this ).data();
        var id = $(this).attr('id-app');

        Swal.fire({
        title: 'Yakin Hapus Config App ini?',
        text: "Tindakan ini tidak dapat dibatalkan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus saja!',
        cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {

                $.post(url+"delete/config/app",
                    {
                        vma_app_config: id
                    },
                    function(resp){

                        console.log(resp);
                        notifTableAjaxSuccess(resp.code, 'TableAppConfig', 'Hapus Config App', resp.message);

                    }
                );
            }
        })

    });

    $(document).on("click", ".editAppConfigButton", function () {

        var id = $(this).data('id');

        $.post(url+"get/config/app/profile",
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
                    //$(".modal-body.est select#"+k+"").val(v);
                    //$(".modal-body.est textarea#"+k+"").text(v);
                });

            }
        );

        $('#editConfigApp').modal('show');

    });

    $('form#frmeditConfigApp').submit(function(e){

        e.preventDefault();
            
        var formData = new FormData(this);

        $.ajax({
            url: url+'update/config/app',
            startTime: performance.now(),
            type: 'POST',
            data: formData,
            //enctype: 'multipart/form-data',
            beforeSend: function() {

                beforeSendLoading(2);   
                
            },
            success: function (data) {

                notifTableAjaxSuccess(data.code, 'TableAppConfig', 'Update Config App', data.message, 'editConfigApp');


            },
            cache: false,
            contentType: false,
            processData: false
        });

    })


})