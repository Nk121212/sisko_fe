function swal_response_insert(code, title, text,modalId){
    Swal.fire({
        icon: (code == '201') ? 'success' : 'error',
        title: title,
        text: text
    }).then(function () {
        $('#'+modalId).modal('hide');
   });
}

function swal_response_update(code, title, text, modalId){
    Swal.fire({
        icon: (code == '200') ? 'success' : 'error',
        title: title,
        text: text
        // footer: '<a href="">Why do I have this issue?</a>'
    }).then(function () {
        $('#'+modalId).modal('hide');
   });
}

function swal_response_delete(code, title, text){
    Swal.fire({
        icon: (code == '200') ? 'success' : 'error',
        title: title,
        text: text
        // footer: '<a href="">Why do I have this issue?</a>'
    })
}

function select_role(idSelect, endPoint){

    $.post(base_url+endPoint,
    {
        //nip: nip
    },
    function(data){
        console.log(data);
        //for (let index = 0; index < data.data.length; index++) {
            //const element = array[index];
            if(data.code == '200'){

                $('#'+idSelect).append('<option value="" disabled selected>Pilih Role</option>');

                $.each(data.data, function(k, v) {
                    $('#'+idSelect).append('<option value="'+v.id+'">'+v.nama_role+'</option>');
                });
                
            }
        //}
        
        //alert("Data: " + data + "\nStatus: " + status);
    });
}