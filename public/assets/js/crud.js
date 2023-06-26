function post(urlPost, csrfToken, data){

    return new Promise(resolve => {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            url: urlPost,
            method: 'POST',
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response, textStatus, xhr)
            {
                resolve(response)
            },
            error: function(response) {
                resolve(response)
            }
        });
    })
}