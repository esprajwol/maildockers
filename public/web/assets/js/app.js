function language(lang, direction){
    $.ajax({
        url: '/setLangSession/'+lang+"/"+direction,
        type: 'GET',
        success: function (data) {
            var resp = $.parseJSON(data);
            if(resp.success){
                location.reload();
            }else{
                alert("error");
            }
        }
    });
}