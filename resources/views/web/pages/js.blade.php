<script>
    let is_download_for_google = true;

    window.updateProgress = null;

    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function progressBar(miliSecond = 500, progressCount = 2) {
        var progress = 0;
        var updateInterval = 95; // Update progress every 100 milliseconds

        window.updateProgress = setInterval(function() {
            progress += getRandomInt(1, progressCount); // Increment progress by 2% (adjust as needed)
            progress = Math.min(progress, updateInterval); // Limit to 100%

            $('.progress-bar')
                .attr('aria-valuenow', progress)
                .css('width', progress + '%')
                .text(progress + '%');

            // Check if simulated progress reaches 100%
            if (progress === 100) {
                clearInterval(window.updateProgress);
            }
        }, miliSecond);
    }

    var myModal = new bootstrap.Modal(document.getElementById('downloadModal'), {
        backdrop: 'static',
        keyboard: false
    });

    var myModalRedis = new bootstrap.Modal(document.getElementById('downloadModalRedis'), {
        backdrop: 'static',
        keyboard: false
    });

    var notificationModalForPdfGeneration = new bootstrap.Modal(document.getElementById(
        'notificationModalForPdfGeneration'), {
        backdrop: 'static',
        keyboard: false
    });


    var totalMessages = 0;

    $(document).ready(function() {
        // $("#privacyPopup").show();
        // $("#privacyPopup").addClass("show-layer");
        // $(".popup").css({"display": "block"});

        @if (session('paid_success'))
            $("#success100PlusOverlayLayout").addClass("show-layer");
            $("#success100-dilog").addClass("show-layer");
            //if(totalMessages < 100){
            // will show the Thank You Modal Here
            //setProgressBarLimitation();
            //  }


            @if (session('pdf_generated_through_job') == 'yes')
                let orderId = "{{ session('order_id') }}";
                // myModalRedis.show();
                // setTimeout(function() {
                //     myModalRedis.hide();
                // }, 3000);
                manualDownloadPDFForRedis(true,orderId);
            @else
                // notificationModalForPdfGeneration.show();
                // setTimeout(function() {
                //     notificationModalForPdfGeneration.hide();
                // }, 3000);

                manualDownloadPDF();
            @endif
        @endif

        @if (session('outlook_paid_success'))
            $("#success100PlusOverlayLayout").addClass("show-layer");
            $("#success100-dilog").addClass("show-layer");
            is_download_for_google = false
            //myModal.show();

            outlookDownloadPDF();

        @endif
    });
    function setProgressBarLimitation() {
        progressBar(300, 3);
    }

    function showHideAjaxModal(show = 1) {
        let showHide = show == 1 ? "show" : "hide";

        $("#ajaxModal").modal(showHide);
    }

    $(document).on("click", ".fireAjax", function(e) {
        e.preventDefault();
        myModal.show();

        setTimeout(function() {
            if (is_download_for_google) {
                manualDownloadPDF();
            } else {
                outlookDownloadPDF();
            }
        }, 500);
    });

    //JS functions for get orders **Start**
    function fetchOrders(page = 1) {
        // $('#loading').show();
        $.ajax({
            url: "{{ route('getOrders') }}",
            method: "GET",
            data: {
                page: page
            },
            success: function(response) {
                $('#orderTableBody').html(response.orders);
                $('#paginationLinks').html(response.pagination);
                bindPaginationLinks();
                $('#loading').hide();
            },
            error: function() {
                $('#loading').text('Failed to load data. Please try again.');
            }
        });
    }

    function bindPaginationLinks() {
        $('#paginationLinks a').on('click', function(event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetchOrders(page);
        });
    }

    $(document).ready(function() {
        $('#loading').show();
        // fetchOrders(); // Initial load

        // bindPaginationLinks();
    });

    // Bind fetchOrders function to the Status tab click event
    $('#nav-status-tab').on('shown.bs.tab', function() {
        fetchOrders(); // Fetch orders when Status tab is clicked
    });
    //JS functions for get orders **End**


    function manualDownloadPDFForRedis(showMyModal = true,orderId) {
        if (!$('#nav-status-tab').hasClass('active')) {
            $('#nav-status-tab').tab('show');
        } //To activate the status page
        // fetchOrders();

        setTimeout(function() {
            $("#success100PlusOverlayLayout").removeClass("show-layer");
            $("#success100-dilog").removeClass("show-layer");

            // Main Task Here
            $.ajax({
                url: "{{ url('/') }}",
                method: 'GET',
                data: {
                    downloadPDF: 'go-ahead'
                },
                timeout: 600000,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response, status, xhr) {

                    fetchOrders(); // Fetch orders to show download btn

                },
                error: function(error) {
                    myModal.hide();
                    console.error('Error generating file through Redis:', error);
                }
            });
        }, 1500);

    }

    function manualDownloadPDF(showMyModal = true) {
        if (!$('#nav-status-tab').hasClass('active')) {
            $('#nav-status-tab').tab('show');
        } //To activate the status page

        // fetchOrders(1); //Fetch the orders


        setTimeout(function() {
            $("#success100PlusOverlayLayout").removeClass("show-layer");
            $("#success100-dilog").removeClass("show-layer");

            $.ajax({
                url: "{{ url('/') }}",
                method: 'GET',
                data: {
                    downloadPDF: 'go-ahead'
                },
                timeout: 600000,
                success: function(response, status, xhr) {

                    setTimeout(function () {
                        fetchOrders();
                    },5000)
                },
                error: function(error) {

                    console.error('Error downloading file:', error);
                    fetchOrders();

                    //showHideAjaxModal(1);
                }
            });
        }, 1500);

    }

    function outlookDownloadPDF() {

        if (!$('#nav-status-tab').hasClass('active')) {
            $('#nav-status-tab').tab('show');
        } //To activate the status page

        // fetchOrders(); //Fetch the orders

        setTimeout(function () {
            $("#success100PlusOverlayLayout").removeClass("show-layer");
            $("#success100-dilog").removeClass("show-layer");

        },1500);

        $.ajax({
            url: '{{ url('/') }}',
            method: 'GET',
            data: {
                downloadPDF: 'go-ahead',
                platform: 'outlook'
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response, status, xhr) {
                /*console.log(response.message_count)
                myModal.hide();

                const filename = xhr.getResponseHeader('Content-Disposition').split('filename=')[1].replace(
                    /['"]/g, '');
                const blob = new Blob([response], {
                    type: 'application/pdf'
                });
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename;
                link.click();
                window.location.href = "{{ url('/') }}";*/
                setTimeout(function () {
                    fetchOrders();
                },5000)
            },
            error: function(error) {
                console.error('Error downloading file:', error);
                fetchOrders();
                //showHideAjaxModal(1);
            }
        });
        //showHideAjaxModal(2);

    }


    async function fetchAndStartTimer(orderId) {
        // Poll API every 1 second until `processing_status > 0`
        const statusCheckInterval = setInterval(async function () {
            try {
                const response = await fetch(`/get-order-status/${orderId}`);
                const result = await response.json();

                if (result.status && result.code === 200) {
                    const data = result.data;
                    const { processing_status, fetch_start_at, total_messages, status } = data;

                    // Stop polling when `processing_status > 0`
                    if (processing_status > 0 && fetch_start_at) {
                        clearInterval(statusCheckInterval);

                        // Start the local timer based on the API data
                        startLocalTimer(orderId, fetch_start_at, total_messages, status);
                    }
                } else {
                    console.error("Error fetching order status:", result.msg);
                    clearInterval(statusCheckInterval);
                }
            } catch (error) {
                console.error("Error fetching order status:", error);
                clearInterval(statusCheckInterval);
            }
        }, 1000); // Poll every second
    }

    function startLocalTimer(orderId, fetchStartAt, totalMessages, status) {
        const countdownElement = document.querySelector(`.countdown-${orderId}`);
        const progressElement = document.querySelector(`#jobProgressShowHere_${orderId} .progress-bar`);

        // Determine time per message based on `totalMessages`
        let timePerMessage;
        if (totalMessages <= 10) {
            timePerMessage = 1; // 1 second per message
        } else if (totalMessages <= 100) {
            timePerMessage = 1.8; // 1.8 seconds per message
        } else {
            timePerMessage = 2.5; // 2.5 seconds per message
        }

        // Total time based on `totalMessages` and dynamic time per message
        let totalTime = Math.ceil(totalMessages * timePerMessage); // in seconds

        // Convert `fetch_start_at` (UTC) to a timestamp
        const startTime = new Date(fetchStartAt).getTime();

        // Variable to track progress over time and avoid frequent updates
        let lastProgress = 0;
        let totalTimeAdjusted = totalTime; // Adjusted time based on progress

        // Timer to update the countdown
        const timerInterval = setInterval(function () {
            const currentTime = new Date().getTime(); // Local time in milliseconds

            const elapsedTime = Math.floor((currentTime - startTime) / 1000); // Elapsed time in seconds

            // Get the current progress from the progress bar
            let progress = parseInt(progressElement.getAttribute('aria-valuenow')) || 0;

            if (progress === 100){
                clearInterval(timerInterval);
                // Calculate the elapsed time in hours, minutes, and seconds
                const totalSeconds = elapsedTime; // Total elapsed time in seconds
                const hours = Math.floor(totalSeconds / 3600);
                const minutes = Math.floor((totalSeconds % 3600) / 60);
                const seconds = totalSeconds % 60;

                // Format the display string
                let timeDisplay = "";
                if (hours > 0) {
                    timeDisplay += `${hours} hour `;
                }
                if (minutes > 0) {
                    timeDisplay += `${minutes} mins `;
                }
                timeDisplay += `${seconds} seconds`; // Always show seconds if no other time unit is displayed

                // Display the completion time
                countdownElement.textContent = `Completed in ${timeDisplay.trim()}`;

            }

            // Only adjust totalTime if the progress has changed meaningfully (e.g., every 5 seconds or significant update)
            if (Math.abs(progress - lastProgress) > 1) {
                totalTimeAdjusted = (elapsedTime / progress) * 100; // Adjust totalTime based on progress
                lastProgress = progress;
            }

            // Calculate remaining time
            const remainingTime = Math.max(totalTimeAdjusted - elapsedTime, 0);

            console.log( "total time:", totalTimeAdjusted, "Elapsed Time:", elapsedTime, "Remaining Time:", remainingTime);

            // Convert remaining time into hours, minutes, and seconds
            const hours = Math.floor(remainingTime / 3600);
            const minutes = Math.floor((remainingTime % 3600) / 60);
            const seconds = Math.floor(remainingTime % 60);

            // Format time display
            let timeDisplay = "";
            if (hours > 0) {
                timeDisplay += `${hours} hour `;
            }
            if (minutes > 0) {
                timeDisplay += `${minutes} mins `;
            }
            timeDisplay += `${seconds} seconds remaining`; // Always show seconds if no other time unit is displayed

            // Update the countdown display
            countdownElement.textContent = timeDisplay.trim();

        }, 1000); // Update countdown every second
    }

    function fetchProgress(orderId) {
        const progressEndpoint = `/job-progress/${orderId}`;
        const progressElement = document.querySelector(`#jobProgressShowHere_${orderId} .progress-bar`);

        const progressInterval = setInterval(function () {
            $.ajax({
                url: progressEndpoint,
                type: 'GET',
                success: function (response) {
                    if (response && response.progress !== undefined) {
                        const progress = Math.floor(response.progress);

                        if (progress > 5) {
                            // Update progress bar
                            progressElement.style.width = progress + '%';
                            progressElement.textContent = progress + '%';
                            progressElement.setAttribute('aria-valuenow', progress);
                            // If progress is 100%, stop the interval and update orders
                            if (progress === 100) {
                                clearInterval(progressInterval); // Stop the interval
                                progressElement.classList.remove('progress-bar-striped');
                                progressElement.classList.add('bg-success');
                                fetchOrders(); // Fetch updated orders
                            }
                        }
                    } else {
                        clearInterval(progressInterval);
                        fetchOrders(); // Fetch updated orders
                    }
                },
                error: function (xhr, status, error) {
                    clearInterval(progressInterval); // Stop the interval if there's an error
                    fetchOrders(); // Fetch updated orders
                }
            });
        }, 3000);
    }

    function notify_order_email(checkbox)
    {
        if(checkbox.checked){
            var notify = 1;
        } else {
            var notify = 0;
        }

        var orderId = checkbox.value;

        var email = document.getElementById("your_email_coupon_ms").value;
        if (email) {
            var notify_email = email;
        } else {
            var notify_email = document.getElementById("your_email_coupon").value;
        }

        if (notify_email) {
            $.ajax({
                url: '{{route("notify_order_email")}}',
                method: 'GET',
                data: { order_id: orderId, notify: notify },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    checkbox.checked = false;
                }
            });
        }
    }

    // Show the popup when the payment button is clicked

    window.addValidationForTheNotifyVia = false;

    // For Microsoft
    $(document).on("click", ".showPrivacyPopUpMS", function() {

        document.getElementById("generate-outlook-pdf-btn").disabled = true;

        var couponValue = document.getElementById("coupon_no_ms").value;
        var your_email_value = document.getElementById("your_email_coupon_ms").value;

        // Check if the length of the input is 5
        if (couponValue.length > 0) {
            $.ajax({
                url: '{{route("validate_coupon")}}',
                method: 'GET',
                data: { coupon_no: couponValue, your_email_coupon: your_email_value },
                success: function(response) {

                    if(response == "valid"){
                        document.getElementById('coupon-success-ms').classList.remove('d-none');
                        document.getElementById('coupon-error-ms').classList.add('d-none');
                        setTimeout(function(){
                            $('#privacyPopup').addClass('show-modal');
                            document.getElementById("generate-outlook-pdf-btn").disabled = false;
                        }, 2000);
                    } else {
                        document.getElementById("generate-outlook-pdf-btn").disabled = false;
                        document.getElementById('coupon-error-ms').classList.remove('d-none');
                        document.getElementById('coupon-success-ms').classList.add('d-none');
                    }

                },
                error: function(xhr, status, error) {
                    // Handle any errors here
                    console.error(error);
                }
            });
        } else {
            document.getElementById('coupon-error').classList.add('d-none');
            document.getElementById('coupon-success').classList.add('d-none');
            document.getElementById("generate-gmail-pdf-btn").disabled = false;
            $('#privacyPopup').addClass('show-modal');
        }



        // $('#privacyPopup').addClass('show-modal');

        return true;

        if (window.addValidationForTheNotifyVia) {
            // Ajax Call
            let notify_channel = $(".notify_channel").val();
            let notify_value = $(".notify_value").val();

            const payloads = {
                notify_channel: notify_channel,
                notify_value: notify_value,
                _token: "{{ csrf_token() }}"
            };

            if (notify_value.length <= 0) {
                $('.error-message').text("Please put the email or phone to notify you about pdf.").show();
                return false;
            } else {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (notify_channel === 'email' && !emailRegex.test(notify_value)) {
                    $('.error-message').text("Please enter a valid email address.").show();
                    return false;
                } else {
                    $.ajax({
                        method: "POST",
                        url: "{{ route('updateOrderNotifyVia') }}",
                        data: payloads,
                        dataType: "JSON",
                        success: function(response) {
                            console.log("Order Notify Info updated", response);
                            //TODO:: show the payment policy
                            $('#privacyPopup').addClass('show-modal');
                        },
                        error: function(xhr, status, error) {
                            console.log("Error is : ", xhr.responseJSON);
                        }
                    });
                }
            }
        } else {
            $('#privacyPopup').addClass('show-modal');
        }

    });

    // For Google
    $(document).on("click", ".showPrivacyPopUp", function() {

        document.getElementById("generate-gmail-pdf-btn").disabled = true;
        document.getElementById("generate-outlook-pdf-btn").disabled = true;

        var couponValue = document.getElementById("coupon_no").value;
        var your_email_value = document.getElementById("your_email_coupon").value;

        // Check if the length of the input is 5
        if (couponValue.length > 0) {
            $.ajax({
                url: '{{route("validate_coupon")}}',
                method: 'GET',
                data: { coupon_no: couponValue, your_email_coupon: your_email_value },
                success: function(response) {

                    if(response == "valid"){
                        document.getElementById('coupon-success').classList.remove('d-none');
                        document.getElementById('coupon-error').classList.add('d-none');
                        setTimeout(function(){
                            $('#privacyPopup').addClass('show-modal');
                            document.getElementById("generate-gmail-pdf-btn").disabled = false;
                        }, 2000);
                    } else {
                        document.getElementById("generate-gmail-pdf-btn").disabled = false;
                        document.getElementById('coupon-error').classList.remove('d-none');
                        document.getElementById('coupon-success').classList.add('d-none');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle any errors here
                    console.error(error);
                }
            });
        } else {
            document.getElementById('coupon-error').classList.add('d-none');
            document.getElementById('coupon-success').classList.add('d-none');
            document.getElementById("generate-gmail-pdf-btn").disabled = false;
            $('#privacyPopup').addClass('show-modal');
        }



        // $('#privacyPopup').addClass('show-modal');

        return true;

        if (window.addValidationForTheNotifyVia) {
            // Ajax Call
            let notify_channel = $(".notify_channel").val();
            let notify_value = $(".notify_value").val();

            const payloads = {
                notify_channel: notify_channel,
                notify_value: notify_value,
                _token: "{{ csrf_token() }}"
            };

            if (notify_value.length <= 0) {
                $('.error-message').text("Please put the email or phone to notify you about pdf.").show();
                return false;
            } else {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (notify_channel === 'email' && !emailRegex.test(notify_value)) {
                    $('.error-message').text("Please enter a valid email address.").show();
                    return false;
                } else {
                    $.ajax({
                        method: "POST",
                        url: "{{ route('updateOrderNotifyVia') }}",
                        data: payloads,
                        dataType: "JSON",
                        success: function(response) {
                            console.log("Order Notify Info updated", response);
                            //TODO:: show the payment policy
                            $('#privacyPopup').addClass('show-modal');
                        },
                        error: function(xhr, status, error) {
                            console.log("Error is : ", xhr.responseJSON);
                        }
                    });
                }
            }
        } else {
            $('#privacyPopup').addClass('show-modal');
        }

    });

    // Hide the popup when the close button is clicked
    $(".close").click(function() {
        $('#privacyPopup').removeClass('show-modal');
    });

    // Hide the popup when the "I Accept" button is clicked
    $("#acceptPrivacy").click(function() {
        $('#privacyPopup').removeClass('show-modal');
        // Proceed with payment logic here
        alert("Proceeding with payment...");
    });

    // Hide the popup when clicking outside the popup content
    $(window).click(function(event) {
        if ($(event.target).is("#privacyPopup")) {
            $('#privacyPopup').removeClass('show-modal');
        }
    });
    // After download btn click reload the order list

    $(document).on('click', '#downloadLink', function(event) {
        setTimeout(function () {
            fetchOrders();
        },2000);
    });

    //refund model
    $(document).on("click", "#requestRefundLink", function(event) {
        // Prevent the default action (which would add # to the URL)
        event.preventDefault();

        // Get the order ID from the link's data attribute
        var orderId = $(this).data('order-id');

        // Add order ID to the hidden input field
        $('#refund-order-id-input').val(orderId);

        // Show the dialog
        $('#refund-dialog').modal('show');

    });

    $(document).on("click", "#refund-cancel-btn", function() {

        // Remove the value from the hidden input field
        $('#refund-order-id-input').val('');

        // Hide the dialog
        $('#refund-dialog').modal('hide');
    });

    $(document).on("click", "#refund-accept-btn", function() {
        // Show the loader
        $('#refund-loader').show();
        $('#refund-title').hide();
        $('#refund-pdf-message').hide();
        $('#refund-cancel-btn').hide();
        $('#refund-accept-btn').hide();


        // Remove the value from the hidden input field
        var orderId = $('#refund-order-id-input').val();

        // Make an AJAX request to request the refund
        $.ajax({
            url: '{{ route("refund.request") }}', // Replace with your actual route
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Include the CSRF token for security
                order_id: orderId // Pass the order ID
            },
            success: function(response) {
                // Hide the loader
                $('#refund-loader').hide();

                // Update the message and show it
                $('#refund-pdf-status-message').text(response.message);
                $('#refund-pdf-message').show();

                $('#refund-cancel-btn').text("{{ localize('close') }}").show();

                // Hide the dialog after a short delay
                setTimeout(function() {
                    // Fetch orders to show the refund status
                    fetchOrders();

                    $('#refund-dialog').modal('hide');
                    $('#refund-cancel-btn').text('Close');
                }, 10000);
            },
            error: function(xhr, status, error) {
                // Hide the loader
                $('#refund-loader').hide();

                // Update the message and show it
                var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Request failed. Please try again.';
                $('#refund-pdf-status-message').text(errorMessage);
                $('#refund-pdf-message').show();
                $('#refund-cancel-btn').hide();

                // Hide the dialog after a short delay
                setTimeout(function() {
                    $('#refund-dialog').modal('hide');
                }, 10000);

                // Handle errors
                console.error('Error:', error);
            }
        });
    });

    //Regenerate pdf section
    $(document).on("click", "#requestRegeneratePdf", function(event) {
        event.preventDefault();

        var orderId = $(this).data('order-id');

        // Show the regenerate PDF modal
        $('#regenerate-pdf-dialog').modal('show');
        $('#regenerate-pdf-loader').show();
        $('#regenerate-pdf-message').hide();
        $('#regenerate-pdf-close-btn').hide();

        // Make an AJAX request to regenerate the PDF
        $.ajax({
            url: '{{ route("regenerate.failed.pdf") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                order_id: orderId
            },
            success: function(response) {
                $('#regenerate-pdf-loader').hide();

                if (response.status) {

                    // Show success message
                    var text = "@lang('pdf-regeneration.request-success')";
                    //$('#regenerate-pdf-status-message').text(text);
                    $('#regenerate-pdf-message').show();
                    $('#regenerate-pdf-status-message-success').show();
                    $('#regenerate-pdf-status-message-error').hide();

                    //fetch orders
                    fetchOrders();

                    // Close modal after 1 second
                    setTimeout(function() {
                        $('#regenerate-pdf-dialog').modal('hide');
                    }, 7000);
                } else {
                    // Show error message
                    var failedText = "@lang('pdf-regeneration.request-fail')" ;
                    //$('#regenerate-pdf-status-message').text(response.message || failedText);
                    $('#regenerate-pdf-message').show();
                    $('#regenerate-pdf-status-message-success').hide();
                    $('#regenerate-pdf-status-message-error').show();
                    $('#regenerate-pdf-close-btn').show();
                }
            },
            error: function(xhr, status, error) {
                $('#regenerate-pdf-loader').hide();

                // Show error message
                $('#regenerate-pdf-status-message').text('Request failed: ' + error);
                $('#regenerate-pdf-message').show();
                $('#regenerate-pdf-close-btn').show();
            }
        });
    });

    // Close button functionality for the modal
    $('#regenerate-pdf-close-btn').on('click', function() {
        $('#regenerate-pdf-dialog').modal('hide');
    });

    function convertToLocalTime(utcDateTime) {
        const localTime = new Date(utcDateTime + ' UTC');
        return localTime.toLocaleString();
    }

    function setUserTimezone(){
        let userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        $.ajax({
            url: "{{ route('set_user_timezone') }}", // Laravel route to store timezone in session
            method: "POST",
            data: {
                timezone: userTimezone,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);
                sessionStorage.setItem('user_timezone', userTimezone);
            }
        });
    }

    $(document).ready(function() {
        if (!sessionStorage.getItem('user_timezone')) setUserTimezone();
    });

    function convertToLocalDateTime(utcDateTime) {
        if (!sessionStorage.getItem('user_timezone')) setUserTimezone();
        var userTimezone = sessionStorage.getItem('user_timezone');
        var date = new Date(utcDateTime + ' UTC');
        var localDate = new Date(date.toLocaleString('en-US', { timeZone: userTimezone }));
        var day = localDate.toLocaleString('en-US', { day: '2-digit' });
        var month = localDate.toLocaleString('en-US', { month: '2-digit' });
        var year = localDate.getFullYear();
        var time = localDate.toTimeString().split(' ')[0]; // HH:mm:ss part

        return `${day}-${month}-${year} ${time}`;
    }

    function convertToLocalDate(utcDateTime) {
        if (!sessionStorage.getItem('user_timezone')) setUserTimezone();
        var userTimezone = sessionStorage.getItem('user_timezone');
        var date = new Date(utcDateTime + ' UTC');
        var localDate = new Date(date.toLocaleString('en-US', { timeZone: userTimezone }));
        var day = localDate.toLocaleString('en-US', { day: '2-digit' });
        var month = localDate.toLocaleString('en-US', { month: '2-digit' });
        var year = localDate.getFullYear();
        var time = localDate.toTimeString().split(' ')[0]; // HH:mm:ss part

        return `${day}-${month}-${year}`;
    }

    function convertToLocalTime(utcDateTime) {
        if (!sessionStorage.getItem('user_timezone')) setUserTimezone();
        var userTimezone = sessionStorage.getItem('user_timezone');
        var date = new Date(utcDateTime);
        var localDate = new Date(date.toLocaleString('en-US', { timeZone: userTimezone }));
        var time = localDate.toTimeString().split(' ')[0]; // HH:mm:ss part
        return time;
    }

</script>
