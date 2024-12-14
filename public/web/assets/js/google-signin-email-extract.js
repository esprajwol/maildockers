var OVERLAY        = '#overlay-layout';
var LOADING        = '#loading-dilog';
var SUCCESS        = '#success-dilog';
var FAILD          = '#faild-dilog';
var DOWNLOAD       = '#download-link';
var DOWNLOADLOGOUT = '#download-link-with-logout';
var FORM           = '#filter-form';
var FAILDMSG       = '#faild-dilog-msg';
var DATA_COUNT     = '#data-count-value';
var BTNGENERATE    = '#btn-generate';


$(document).ready(function(){
    // $(".showWhenMsgCrossed100").removeClass("d-none");
    // $(SUCCESS).addClass("show-layer");
    // $(OVERLAY).addClass("show-layer");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Reset data count to 0 every time page reload
    $(DATA_COUNT).text(0);

    // Chacking if session has stored previous ajaxRequest
    if (hasSessionStored()) {
        $(OVERLAY).addClass("show-layer");
        $(LOADING).addClass("show-layer");
        continueAjaxRequest();
    }

    $('#retry-gmail-pdf-btn').click(function() {
        removeAjaxState();
        $(OVERLAY).removeClass('show-layer');
    });

    $('#generate-gmail-pdf-btn').click(function(){
        var coupon_no = document.getElementById("coupon_no").value;
        document.getElementById("coupon_no_submit").value = coupon_no;

        var your_email_coupon = document.getElementById("your_email_coupon").value;
        document.getElementById("your_email_coupon_submit").value = your_email_coupon;
    });

    function hasSessionStored() {
        var request = JSON.parse(sessionStorage.getItem("ajaxRequest"));
        if(request){
            return true;
        } else {
            return false;
        }
    }


    function enableNotifyChannel(dataCount = 0){
        if(dataCount >=100){
            window.addValidationForTheNotifyVia = true
            $(".showWhenMsgCrossed100").removeClass("d-none");
        }
    }

    // Function to retrieve saved AJAX request state and continue request
    function continueAjaxRequest() {

        setTimeout(function () {
            // Retrieve saved AJAX request state and continue request with saved access token// Get the stored request data
            var request = JSON.parse(sessionStorage.getItem("ajaxRequest"));
            // Btn-loading
            $(BTNGENERATE).text('Processing...');
            $(BTNGENERATE).prop('disabled', true);

            //hide both button
            $("#generate-gmail-pdf-btn").hide();
            $("#retry-gmail-pdf-btn").hide();
            // Send the AJAX request using the stored data
            $.ajax({
                url: request.url,
                method: request.method,
                data: request.data,
                dataType: request.dataType,
                contentType: request.contentType,
                cache: request.cache,
                processData: request.processData,
                async : request.async,
                beforeSend: function() {

                },
                success:function(response)
                {
                    console.log("Server Response :"+ response);

                    if (response.data_count === 0){
                        //show the retry btn
                        $("#retry-gmail-pdf-btn").show();
                    }else {
                        // show the generate pdf btn
                        $("#generate-gmail-pdf-btn").show();
                    }

                    $(LOADING).removeClass("show-layer");
                    //TODO:: show the Notify Via & Phone Section from Here.
                    enableNotifyChannel(response.data_count);

                    // Empty count
                    $(DATA_COUNT).text(0);
                    // Set the value of n (the number to count up to)
                    var n = response.data_count;
                    var an = response.data_count + 1;
                    // Set the duration of the animation (in milliseconds)
                    var duration = 500; // 1000 / 2 = 500, .5sec

                    // Start the animation using jQuery's animate() function
                    // $(DATA_COUNT).animate({ num: an }, {
                    //     duration: duration,
                    //     step: function() {
                    //         $(this).text(Math.floor(this.num));
                    //         if (this.num >= an) {
                    //             $(this).finish();
                    //         }
                    //     },
                    //     complete: function() {
                    //         this.num = 0;
                    //     }
                    // });

                    setTimeout(function() {
                        $(DATA_COUNT).stop();
                        $(LOADING).removeClass("show-layer");
                        $(SUCCESS).addClass("show-layer");

                        if(response.download_status){
                            $(DOWNLOAD).attr('download-file', response.download_file);
                            $(DOWNLOADLOGOUT).attr('download-file', response.download_file);
                            $('#data_count').html(response.data_count)
                        } else {
                            $(LOADING).removeClass("show-layer");
                            $(SUCCESS).removeClass("show-layer");
                            $(FAILD).addClass("show-layer");
                            $(FAILDMSG).empty().append(response.complete_message);
                            setTimeout(function() {
                                $(OVERLAY).removeClass("show-layer");
                                $(FAILD).removeClass("show-layer");
                            }, 3000);
                        }

                        $(FORM).trigger("reset");
                        $(BTNGENERATE).text('Generate');
                        $(BTNGENERATE).prop('disabled', false);
                        removeAjaxState();
                    }, 500);
                },
                error: function(response) {
                    removeAjaxState();
                    $(LOADING).removeClass("show-layer");
                    var error = response.responseJSON;
                    // console.log(response);
                    if (typeof error === 'undefined') {
                        // Handle the undefined response
                        console.log('Response is undefined');
                        $(FAILD).addClass("show-layer");
                        $(FAILDMSG).empty().append("Unauthenticated!: User Deined Request.");
                        setTimeout(function() {
                            $(OVERLAY).removeClass("show-layer");
                            $(FAILD).removeClass("show-layer");
                        }, 3000);
                    } else {
                        if(error.errors) {
                            if(Object.keys(error.errors).length !== 0) {
                                $(OVERLAY).removeClass("show-layer");
                                $.each(error.errors, function (key, value) {
                                    var input = '#filter-form input[name=' + key + ']';
                                    $(input + ' + small').text(value);
                                    $(input).addClass('is-invalid');
                                });
                            }
                        } else if(error.exception) {
                            $(FAILD).addClass("show-layer");
                            $(FAILDMSG).empty().append(error.error_msg);
                            setTimeout(function() {
                                $(OVERLAY).removeClass("show-layer");
                                $(FAILD).removeClass("show-layer");
                            }, 3000);
                        } else if(error.catch) {
                            $(FAILD).addClass("show-layer");
                            $(FAILDMSG).empty().append(error.catch);
                            setTimeout(function() {
                                $(OVERLAY).removeClass("show-layer");
                                $(FAILD).removeClass("show-layer");
                            }, 3000);
                        } else if(error.error_msg) {
                            $(FAILD).addClass("show-layer");
                            $(FAILDMSG).empty().append(error.error_msg);
                            setTimeout(function() {
                                $(OVERLAY).removeClass("show-layer");
                                $(FAILD).removeClass("show-layer");
                            }, 3000);
                        } else {
                            $(FAILD).removeClass("show-layer");
                            setTimeout(function() {
                                $(OVERLAY).removeClass("show-layer");
                            }, 3000);
                        }
                    }


                    $(BTNGENERATE).text('Generate');
                    $(BTNGENERATE).prop('disabled', false);
                }
            });
        },1000);

    }

    function removeAjaxState() {
        // Remove the "ajaxRequest" key from the session storage
        sessionStorage.removeItem("ajaxRequest");
    }

    $(FORM).on('submit', function(event){
        event.preventDefault();
        var url = $(this).attr('data-action');
        // $(BTNGENERATE).prop('disabled', true);
        // Check if user is authenticated with Google OAuth
        if (isAuthenticated() === true) {
            // User is authenticated, send AJAX request
            $(OVERLAY).addClass("show-layer");
            $(LOADING).addClass("show-layer");
            sendAjaxRequest(url);
        } else {
            // User is not authenticated, redirect to Google OAuth authentication page
            saveAjaxState(url);
            redirectToGoogleOAuth();
        }
    });

     // Function to check if user is authenticated with Google OAuth
    function isAuthenticated() {
        var value = $(FORM).attr('data-login-state');
        if(value === "1") { return true; } else { return false; }
    }

    // Function to save AJAX request state
    function saveAjaxState(url) {
        var formData = $(FORM).serialize();
        // Create an object to store the request data
        var request = {
            "url": url,
            "data": formData,
            "method": 'POST',
            "dataType": 'JSON',
            "contentType": 'application/x-www-form-urlencoded; charset=UTF-8',
            "cache": false,
            "processData": false,
            "async" : false,
        };

        // Store the request data in session storage
        sessionStorage.setItem("ajaxRequest", JSON.stringify(request));
    }

    // Function to redirect to Google OAuth authentication page
    function redirectToGoogleOAuth() {
        // Redirect user to Google OAuth authentication page
        var FORM = '#filter-form';
        var authUrl = $(FORM).attr('data-auth-url');
        window.location.href = authUrl;
    }

    // Function to send AJAX request with access token
    function sendAjaxRequest(url) {
        console.log("Send the AJAX request with the access token");

        var form = $(FORM)[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        // Btn-loading
        $(BTNGENERATE).text('Generate');
        $(BTNGENERATE).prop('disabled', false);

        //hide both button
        $("#generate-gmail-pdf-btn").hide();
        $("#retry-gmail-pdf-btn").hide();

        //Send the AJAX request with the access token
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            async : false,
            beforeSend: function() {
                // Btn-loadingdataCountAnimation


                let processingText = `<div class="spinner-border text-success"></div> Processing...`;
                $(BTNGENERATE).html(processingText);
                $(BTNGENERATE).prop('disabled', true);

            },
            success:function(response)
            {
                console.log("Server Response: "+ response);

                if (response.data_count === 0){
                    //show the retry btn
                    $("#retry-gmail-pdf-btn").show();
                }else {
                    // show the generate pdf btn
                    $("#generate-gmail-pdf-btn").show();
                }

                //TODO:: show the Notify Via & Phone Section from Here.
                enableNotifyChannel(response.data_count);

                $('#data_count').html(response.data_count)
                // Empty count
                $(DATA_COUNT).text(0);
                // Set the value of n (the number to count up to)
                var n = response.data_count;
                var an = response.data_count + 1;
                // Set the duration of the animation (in milliseconds)
                var duration = 500; // 1000 / 2 = 500, .5sec

                // Start the animation using jQuery's animate() function
                dataCountAnimation($(this),an, duration);

                // Timeout Function calling
                timeoutFunForSendAjaxRequest(response);
            },
            error: function(response) {
                $(BTNGENERATE).text('Generate');
                $(BTNGENERATE).prop('disabled', false);
                $(LOADING).removeClass("show-layer");

                errorFunOfSendAjaxRequest(response.responseJSON);
            }
        });
        // setTimeout(function () {
        //
        // },1000);
    }

    function errorFunOfSendAjaxRequest(error){
        if (typeof error === 'undefined') {
            // Handle the undefined response
            // console.log('Response is undefined');
            $(FAILD).addClass("show-layer");
            $(FAILDMSG).empty().append("Unauthenticated!: User Deined Request.");
            setTimeout(function() {
                $(OVERLAY).removeClass("show-layer");
                $(FAILD).removeClass("show-layer");
            }, 3000);
        }
        else {
            if(error.errors) {
                if(Object.keys(error.errors).length !== 0) {
                    $(OVERLAY).removeClass("show-layer");
                    $.each(error.errors, function (key, value) {
                        var input = '#filter-form input[name=' + key + ']';
                        $(input + ' + small').text(value);
                        $(input).addClass('is-invalid');
                    });
                }
            }
            else if(error.exception) {
                $(FAILD).addClass("show-layer");
                $(FAILDMSG).empty().append(error.error_msg);
                setTimeout(function() {
                    $(OVERLAY).removeClass("show-layer");
                    $(FAILD).removeClass("show-layer");
                }, 3000);
            }
            else if(error.catch) {
                $(FAILD).addClass("show-layer");
                $(FAILDMSG).empty().append(error.catch);
                setTimeout(function() {
                    $(OVERLAY).removeClass("show-layer");
                    $(FAILD).removeClass("show-layer");
                }, 3000);
            }
            else if(error.error_msg) {
                $(FAILD).addClass("show-layer");
                $(FAILDMSG).empty().append(error.error_msg);
                setTimeout(function() {
                    $(OVERLAY).removeClass("show-layer");
                    $(FAILD).removeClass("show-layer");
                }, 3000);
            }
            else {
                $(FAILD).removeClass("show-layer");
                setTimeout(function() {
                    $(OVERLAY).removeClass("show-layer");
                }, 3000);
            }
        }
    }

    function timeoutFunForSendAjaxRequest(response){
        setTimeout(function() {
            $(LOADING).removeClass("show-layer");
            $(SUCCESS).addClass("show-layer");

            if(response.download_status){
                $(DOWNLOAD).attr('download-file', response.download_file);
                $(DOWNLOADLOGOUT).attr('download-file', response.download_file);
                $('#data_count').html(response.data_count)
            } else {
                // loading Hide
                removeElement(LOADING);

                // Success Hide
                removeElement(SUCCESS);

                // Failed Class Added.
                addElement(FAILD);

                $(FAILDMSG).empty().append(response.complete_message);
                setTimeout(function() {
                    //Overlay Remove
                    removeElement(OVERLAY);

                    // Failed Remove class
                    removeElement(FAILD);
                }, 500);
            }

            $(FORM).trigger("reset");
            $(BTNGENERATE).text('Generate');
            $(BTNGENERATE).prop('disabled', false);
            $('#data_count').html(response.data_count)

            //TODO::Show input box when

        }, 1000);
    }

    function dataCountAnimation(thisElement, an, duration){
        $(DATA_COUNT).animate({ num: an }, {
            duration: duration,
            step: function() {
                thisElement.text(Math.floor(this.num));
                if (this.num >= an) {
                    thisElement.finish();
                }
            },
            complete: function() {
                this.num = 0;
            }
        });
    }

    function removeElement(selector, className = "show-layer"){
        $(selector).removeClass(className);
    }

    function addElement(selector, className = "show-layer"){
        $(selector).addClass(className);
    }

    $(DOWNLOADLOGOUT).on('click', function(event) {
        event.preventDefault();
        var filename = $(this).attr('download-file');
        var routeDwn = $(this).attr('data-download-url');
        var routeDlte = $(this).attr('data-destroy-url');
        var logoutUrl = $(this).attr('data-user-logout');
        var urlDownload = routeDwn + '/' + filename;
        var urlDelete = routeDlte + '/' + filename;

        $.ajax({
            url: urlDownload,
            method: 'POST',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                a.href = url;
                a.download = filename;
                document.body.append(a);
                a.click();
                a.remove();

                setTimeout(function() {
                    $(SUCCESS).removeClass("show-layer");
                    $(OVERLAY).removeClass("show-layer");

                    // Delete the file after download
                    $.ajax({
                        url: urlDelete,
                        method: 'DELETE'
                    });

                    window.location.href = logoutUrl;
                }, 2000);
            }
        });
    });

    $(DOWNLOAD).on('click', function(event){
        event.preventDefault();
        var filename = $(this).attr('download-file');
        var routeDwn = $(this).attr('data-download-url');
        var routeDlte = $(this).attr('data-destroy-url');
        var urlDownload = routeDwn + '/' + filename;
        var urlDelete = routeDlte + '/' + filename;

        $.ajax({
            url: urlDownload,
            method: 'POST',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                a.href = url;
                a.download = filename;
                document.body.append(a);
                a.click();
                a.remove();

                setTimeout(function() {
                    $(SUCCESS).removeClass("show-layer");
                    $(OVERLAY).removeClass("show-layer");

                    // Delete the file after download
                    $.ajax({
                        url: urlDelete,
                        method: 'DELETE'
                    });
                }, 1000);
            }
        });
    });
});
