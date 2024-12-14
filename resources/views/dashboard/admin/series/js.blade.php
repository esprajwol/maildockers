@php $appStatic = appStatic();

 $fethRequest = $appStatic::FETCH_DISTRIBUTOR_MODELS;

@endphp
<script>
    "use strict";

    $(document).on("change",".userId", function (e) {
        let user_id = $(this).val();

        console.log("User Id ", user_id);
        if(user_id){
            let callParams = {};

            callParams.method = "GET";
            callParams.url = "{{ route('admin.models.index') }}";
            callParams.data = {
                user_id: user_id,
                fetchRequest: "{{ $fethRequest }}"
            };

            ajaxCall(callParams, function (response) {
                console.log("Server Request ", response);

                let options = generateOptionFromResponse(response.data);

                console.log("Options ", options);

                $(".modelId").html(options);


            },function (XHR, textStatus, errorThrown) {
                console.log(XHR.responseText);
                console.log(textStatus);
                console.log(errorThrown);
            })
        }
    })


    function generateOptionFromResponse(data){
        let options = ''; // Initialize an empty string to store options

        data.forEach(function(item) {
            // Construct each option using backticks
            options += `<option value="${item.id}">${item.model_name}</option>`;
        });

        return options;
    }
</script>
