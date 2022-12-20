$(document).ready(function(){

    $('form#frmAddNews').submit(function(e){

        var id_button = $(document.activeElement).attr("id");
        console.log('id button clicked '+id_button);
    
        e.preventDefault();
    
        /*if ($('form#FrmInsertMutasi')[0].checkValidity() === false) {
            e.stopPropagation();
        } else {
            
        }
    
        $('#FrmInsertMutasi').addClass('was-validated');*/
            
        var formData = new FormData(this);
        
    
            $.ajax({
                url: url+'insert/news',
                startTime: performance.now(),
                type: 'POST',
                data: formData,
                enctype: 'multipart/form-data',
                beforeSend: function() {
    
                    beforeSendLoading(2);   
                    
                },
                success: function (data) {
    
                    if(data.code == '201'){
    
                        var icon = "success";
                        var title = 'Insert News';
                        var message = data.message;
                        var redirect = 'news/adminstaff';
    
                    }else if(data.code == '400'){
    
                        var icon = "error";
                        var title = 'Insert News';
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

})