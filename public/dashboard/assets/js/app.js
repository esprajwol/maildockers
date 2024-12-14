
function ajaxCall(callParams, successCallBack, errorCallBack, optionalParams) {

    console.log("Call Params ", callParams);
    $.ajax({
        url     : callParams.url,
        method  : callParams.method,
        data    : callParams.data,
        dataType: callParams.dataType || "JSON",
        success : successCallBack,
        error   : errorCallBack
    });
}

$(document).on("click", ".cmnImg", function (e) {
    let src = $(this).attr("src");


    // let modalImg = document.querySelector('.modalImg');
    // modalImg.src = src;
    // modal.style.display = "block";
    // modal.style.display = "block";

    $(".modalImg").attr("src", src);

    $("#imgCommonModal").modal("show");
})

