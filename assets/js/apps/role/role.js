$(document).ready(function(){

    $('form#frmaddRole').submit(function(e){

        var id_button = $(document.activeElement).attr("id");
        //console.log('id button clicked '+id_button);
    
        e.preventDefault();
            
        var formData = new FormData(this);
        
    
            $.ajax({
                url: url+'insert/role',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {
    
                    beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    notifTableAjaxSuccess(data.code, 'TableRole', 'Insert Role', data.message, 'addRole');
                    $('form#frmaddRole')[0].reset();
    
                },
                cache: false,
                contentType: false,
                processData: false
            });
        
    })

        //var table = $('#tableArea').DataTable();

    $('#TableRole tbody').on('click', 'tr td a.del', function () {
        //var data = table.row( this ).data();
        var id = $(this).attr('id-role');

        Swal.fire({
        title: 'Yakin Hapus Role Type ini?',
        text: "Tindakan ini tidak dapat dibatalkan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus saja!',
        cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {

                $.post(url+"delete/role",
                    {
                        vmur_role: id
                    },
                    function(resp){

                        console.log(resp);
                        notifTableAjaxSuccess(resp.code, 'TableRole', 'Hapus Role', resp.message);

                    }
                );
            }
        })

    });

    $(document).on("click", ".editRoleButton", function () {

        var id = $(this).data('id');

        $.post(url+"get/role/profile",
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
                    $(".modal-body.est textarea#"+k+"").text(v);
                });

            }
        );

        $('#editRole').modal('show');

    });

    $('form#frmeditRole').submit(function(e){

        e.preventDefault();
            
        var formData = new FormData(this);

        $.ajax({
            url: url+'update/role',
            startTime: performance.now(),
            type: 'POST',
            data: formData,
            //enctype: 'multipart/form-data',
            beforeSend: function() {

                beforeSendLoading(2);   
                
            },
            success: function (data) {

                notifTableAjaxSuccess(data.code, 'TableRole', 'Update Role', data.message, 'editRole');


            },
            cache: false,
            contentType: false,
            processData: false
        });

    })


})