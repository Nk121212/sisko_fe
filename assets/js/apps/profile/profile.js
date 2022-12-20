$(document).ready(function(){

    $('form#frmEditProfileWp').submit(function(e){

        var id_button = $(document.activeElement).attr("id");
        //console.log('id button clicked '+id_button);
    
        e.preventDefault();
            
        var formData = new FormData(this);
        
    
            $.ajax({
                url: url+'update/profile',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {
    
                    beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);

                    var message = (data.RC == "0000") ? "Update Berhasil" : "Update Gagal";
                    notifAjaxMasago(data.RC, 'Update Profile WP', message);

                    //notifTableAjaxSuccess(data.code, 'TableRole', 'Insert Role', data.message, 'addRole');
    
                },
                cache: false,
                contentType: false,
                processData: false
            });
        
    })

})