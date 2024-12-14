$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let OVERLAY        = '#overlay-layout';
    let LOADING        = '#loading-dilog';
    let SUCCESS        = '#success-dilog';
    let FAILD          = '#faild-dilog';
    let DOWNLOAD       = '#download-link';
    let DOWNLOADLOGOUT = '#download-link-with-logout';
    let FORM           = '#filter-form';
    let FAILDMSG       = '#faild-dilog-msg';
    let DATA_COUNT     = '#data-count-value';
    let BTNGENERATE    = '#btn-generate';

    // Reset data count to 0 every time page reload
    $(DATA_COUNT).text(0);

    // Chacking if session has stored previous ajaxRequest
    if (hasSessionStored()) {
        continueAjaxRequest();
    }

    function hasSessionStored() {
        let request = JSON.parse(sessionStorage.getItem("ajaxRequest"));

        return !!request;
    }

    // Function to retrieve saved AJAX request state and continue request
    function continueAjaxRequest() {
        // Retrieve saved AJAX request state and continue request with saved access token// Get the stored request data
        var request = JSON.parse(sessionStorage.getItem("ajaxRequest"));
        // Btn-loading
        $(BTNGENERATE).text('Processing...');
        $(BTNGENERATE).prop('disabled', true);
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
                $(OVERLAY).addClass("show-layer");
                $(LOADING).addClass("show-layer");
            },
            success:function(response)
            {
                // Empty count
                $(DATA_COUNT).text(0);
                // Set the value of n (the number to count up to)
                var n = response.data_count;
                var an = response.data_count + 1;
                // Set the duration of the animation (in milliseconds)
                var duration = n * 500; // 1000 / 2 = 500, .5sec

                // Start the animation using jQuery's animate() function
                $(DATA_COUNT).animate({ num: an }, {
                    duration: duration,
                    step: function() {
                        $(this).text(Math.floor(this.num));
                        if (this.num >= an) {
                            $(this).finish();
                        }
                    },
                    complete: function() {
                        this.num = 0;
                    }
                });

                setTimeout(function() {
                    $(DATA_COUNT).stop();
                    $(LOADING).removeClass("show-layer");
                    $(SUCCESS).addClass("show-layer");

                    if(response.download_status){
                        $(DOWNLOAD).attr('download-file', response.download_file);
                        $(DOWNLOADLOGOUT).attr('download-file', response.download_file);
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
                }, n * 550);
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
            sendAjaxRequest();
        } else {
            // User is not authenticated, redirect to Google OAuth authentication page
            saveAjaxState();
            redirectToGoogleOAuth();
        }

        // Function to check if user is authenticated with Google OAuth
        function isAuthenticated() {
            var value = $(FORM).attr('data-login-state');
            if(value === "1") { return true; } else { return false; }
        }

        // Function to save AJAX request state
        function saveAjaxState() {
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
        function sendAjaxRequest() {
            var form = $(FORM)[0]; // You need to use standard javascript object here
            var formData = new FormData(form);
            // Btn-loading
            $(BTNGENERATE).text('Generate');
            $(BTNGENERATE).prop('disabled', false);
            // Send the AJAX request with the access token
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
                    // Btn-loading
                    $(BTNGENERATE).text('Processing...');
                    $(BTNGENERATE).prop('disabled', true);

                    $(OVERLAY).addClass("show-layer");
                    $(LOADING).addClass("show-layer");
                },
                success:function(response)
                {
                    // Empty count
                    $(DATA_COUNT).text(0);
                    // Set the value of n (the number to count up to)
                    var n = response.data_count;
                    var an = response.data_count + 1;
                    // Set the duration of the animation (in milliseconds)
                    var duration = n * 500; // 1000 / 2 = 500, .5sec

                    // Start the animation using jQuery's animate() function
                    $(DATA_COUNT).animate({ num: an }, {
                        duration: duration,
                        step: function() {
                            $(this).text(Math.floor(this.num));
                            if (this.num >= an) {
                                $(this).finish();
                            }
                        },
                        complete: function() {
                            this.num = 0;
                        }
                    });

                    setTimeout(function() {
                        $(LOADING).removeClass("show-layer");
                        $(SUCCESS).addClass("show-layer");

                        if(response.download_status){
                            $(DOWNLOAD).attr('download-file', response.download_file);
                            $(DOWNLOADLOGOUT).attr('download-file', response.download_file);
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

                    }, n * 550);

                },
                error: function(response) {
                    $(LOADING).removeClass("show-layer");
                    var error = response.responseJSON;
                    if (typeof error === 'undefined') {
                        // Handle the undefined response
                        // console.log('Response is undefined');
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
        }
    });

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
