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

    $('select#prov').change(function(){

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

    })

    $('form#frmAddArea').submit(function(e){

        var id_button = $(document.activeElement).attr("id");
        console.log('id button clicked '+id_button);
    
        e.preventDefault();
            
        var formData = new FormData(this);
        
    
            $.ajax({
                url: url+'insert/area',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {
    
                    beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    notifTableAjaxSuccess(data.code, 'tableArea', 'Insert Area', data.message, "addArea");
                    $('form#frmAddArea')[0].reset();
    
    
                },
                cache: false,
                contentType: false,
                processData: false
            });
        
    })

        //var table = $('#tableArea').DataTable();

    $('#tableArea tbody').on('click', 'tr td a.del', function () {
        //var data = table.row( this ).data();
        var id_area = $(this).attr('id-area');

        Swal.fire({
        title: 'Yakin Hapus Area ini?',
        text: "Tindakan ini tidak dapat dibatalkan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus saja!',
        cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {

                $.post(url+"delete/area",
                    {
                        vma_code: id_area
                    },
                    function(resp){

                        console.log(resp);
                        notifTableAjaxSuccess(resp.code, 'tableArea', 'Hapus Area', resp.message);

                    }
                );
            }
        })

    });

    $(document).on("click", ".editAreaButton", function () {

        var id_area = $(this).data('id');

        $.post(url+"get/area/profile",
            {
                id: id_area
            },
            function(resp){

                console.log(resp.data.area);
                //return false;
                $.each(resp.data.area[0], function(k, v) {
                    //console.log(k);
                    //console.log(v);
                    $(".modal-body.ea input#"+k+"").val(v);
                    $(".modal-body.ea select#"+k+"").val(v);
                });

            }
        );

        $('#editArea').modal('show');

    });

    $('form#frmEditArea').submit(function(e){

        //var id_button = $(document.activeElement).attr("id");
        //console.log('id button clicked '+id_button);

        e.preventDefault();
            
        var formData = new FormData(this);

        $.ajax({
            url: url+'update/area',
            startTime: performance.now(),
            type: 'POST',
            data: formData,
            //enctype: 'multipart/form-data',
            beforeSend: function() {

                beforeSendLoading(2);   
                
            },
            success: function (data) {

                notifTableAjaxSuccess(data.code, 'tableArea', 'Update Area', data.message, "editArea");


            },
            cache: false,
            contentType: false,
            processData: false
        });

    })


})