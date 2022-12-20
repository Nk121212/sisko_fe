$(document).ready(function(){

    $('form#frmChangePass').submit(function(e){
    
        e.preventDefault();
            
        var formData = new FormData(this);
        
    
            $.ajax({
                url: url+'update/password',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {
    
                    beforeSendLoading(2);   
                    
                },
                success: function (data) {
                    console.log(data);
                    if(data.isVtax == 0){
                        
                        if(data.RC == '0000'){
                            var message = "Success";
                            var redirect = "logout";
                        }else{
                            var message = data.RCM;
                            var redirect = "";
                        }

                        notifAjaxMasago(data.RC, 'Change Password', message, redirect);

                    }else{
                    
                        if(data.code == '200'){
                            var icon = 'success';
                            var redirect = 'logout';
                        }else{
                            var icon = 'error';
                            var redirect = '';
                        }

                        notifAjaxSuccessWithRedirect(icon, 'Change Password', data.message, redirect);

                    }
                    
    
                },
                cache: false,
                contentType: false,
                processData: false
            });
        
    })

})