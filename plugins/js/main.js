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