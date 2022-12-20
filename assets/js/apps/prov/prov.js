$(document).ready(function(){

    $.post(url+"get/provinsi",
        {
            //id: idUsers
        },
        function(resp){

            //console.log(resp.data.province);
            if(resp.code == '200'){

                $('select#prov').append("<option value=''>Pilih Provinsi</option>");
                $('select#vma_prov_code').append("<option value=''>Pilih Provinsi</option>");

                $.each(resp.data.province, function(k, v) {
                    $('select#prov').append("<option value="+v.vmp_code+">"+v.vmp_name+"</option>"); 
                    $('select#vma_prov_code').append("<option value="+v.vmp_code+">"+v.vmp_name+"</option>");  
                });

            } 

        }
    );

    /*$('select#prov').change(function(){

        var prov_kode = $(this).val();

        $.post(url+"get/area/"+prov_kode,
        {
            //id: idUsers
        },
        function(resp){

            //console.log(resp.data.province);
            if(resp.code == '200'){

                $('select#area').append("<option value=''>Pilih Area</option>");

                $.each(resp.data.area, function(k, v) {
                    $('select#area').append("<option prov-code="+v.vma_prov_code+" value="+v.vma_code+">"+v.vma_name+"</option>");  
                });

            } 

        })

    })*/

    $('form#frmAddProv').submit(function(e){

        var id_button = $(document.activeElement).attr("id");
        console.log('id button clicked '+id_button);
    
        e.preventDefault();
            
        var formData = new FormData(this);
        
    
            $.ajax({
                url: url+'insert/prov',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {
    
                    beforeSendLoading(2);   
                    
                },
                success: function (data) {
    
                    notifTableAjaxSuccess(data.code, 'tableProv', 'Insert Provinsi', data.message, "addProv");
                    $('form#frmAddProv')[0].reset();
    
                },
                cache: false,
                contentType: false,
                processData: false
            });
        
    })

        //var table = $('#tableArea').DataTable();

    $('#tableProv tbody').on('click', 'tr td a.del', function () {
        //var data = table.row( this ).data();
        var id_prov = $(this).attr('id-prov');

        Swal.fire({
        title: 'Yakin Hapus Province ini?',
        text: "Tindakan ini tidak dapat dibatalkan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus saja!',
        cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {

                $.post(url+"delete/prov",
                    {
                        vmp_code: id_prov
                    },
                    function(resp){

                        console.log(resp);
                        notifTableAjaxSuccess(resp.code, 'tableProv', 'Hapus Province', resp.message);

                    }
                );
            }
        })

    });

    $(document).on("click", ".editProvButton", function () {

        var id_prov = $(this).data('id');

        $.post(url+"get/prov/profile",
            {
                id: id_prov
            },
            function(resp){

                console.log(resp.data.region);
                //return false;
                $.each(resp.data.region[0], function(k, v) {
                    //console.log(k);
                    //console.log(v);
                    $(".modal-body.ep input#"+k+"").val(v);
                    $(".modal-body.ep select#"+k+"").val(v);
                });

            }
        );

        $('#editProv').modal('show');

    });

    $('form#frmEditProv').submit(function(e){

        //var id_button = $(document.activeElement).attr("id");
        //console.log('id button clicked '+id_button);

        e.preventDefault();
            
        var formData = new FormData(this);

        $.ajax({
            url: url+'update/prov',
            startTime: performance.now(),
            type: 'POST',
            data: formData,
            //enctype: 'multipart/form-data',
            beforeSend: function() {

                beforeSendLoading(2);   
                
            },
            success: function (data) {

                notifTableAjaxSuccess(data.code, 'tableProv', 'Update Provinsi', data.message, "editProv");


            },
            cache: false,
            contentType: false,
            processData: false
        });

    })


})