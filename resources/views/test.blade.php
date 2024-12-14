{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <title>Progress Bar Example</title>--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
{{--    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="container mt-5">--}}
{{--    <button id="start-process" class="btn btn-primary">Start Process</button>--}}

{{--    <!-- Modal -->--}}
{{--    <div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="progressModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="progressModalLabel">Processing...</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="progress">--}}
{{--                        <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                    </div>--}}
{{--                    <div id="progress-text" class="mt-2">0% completed</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<!DOCTYPE html>
<html>
    <head>
        <title>Progress Bar with AJAX</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>

        <button type="button" class="btn btn-primary" id="ajax-button">Start Progress</button>

        <div class="modal fade" id="progressModal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Progress</h4>
                    </div>
                    <div class="modal-body">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>

            $(document).ready(function() {
                $('#ajax-button').click(function() {
                    $('#progressModal').modal('show'); // Show progress modal

                    progressBar();

                    $.ajax({
                        url: '{{ url("/test") }}', // Replace with your actual route
                        type: 'GET', // Replace with your desired request method (GET, POST, etc.)
                        success: function(response) {
                            let updateInterval = 95;

                            $('.progress-bar').attr('aria-valuenow', updateInterval)
                                .css('width', updateInterval + '%')
                                .text(updateInterval + '%');

                           // clearInterval(updateProgress);

                         //   $('#progressModal').modal('hide'); // Hide progress modal on success
                            console.log(response); // Handle response data (optional)
                        },
                        error: function(error) {
                            clearInterval(updateProgress);

                            $('#progressModal').modal('hide'); // Hide progress modal on error
                            console.error(error); // Handle error
                        },
                        xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total; // Calculate actual progress
                                    progress = Math.round(percentComplete * 100); // Update progress variable

                                    // Update progress bar inside the listener (**change here**):
                                    $('.progress-bar').attr('aria-valuenow', progress).css('width', progress + '%').text(progress + '%');
                                }
                            });
                            return xhr;
                        }
                    });
                });
            });

            $('#start-process').click(function(){
                    $('#progress-bar').css('width', '0%').attr('aria-valuenow', 0);
                    $('#progress-text').text('0% completed');
                    $('#progressModal').modal('show');

                    $.ajax({
                        url: '{{ url('test') }}',
                        method: 'GET',
                        xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.onprogress = function(e) {
                                if (e.lengthComputable) {
                                    var percentComplete = e.loaded / e.total * 100;
                                    $('#progress-bar').css('width', percentComplete + '%').attr('aria-valuenow', percentComplete);
                                    $('#progress-text').text(Math.round(percentComplete) + '% completed');
                                }
                            };
                            return xhr;
                        },
                        success: function(response) {
                            $('#progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                            $('#progress-text').text('100% completed');
                            setTimeout(function(){
                                $('#progressModal').modal('hide');
                                alert(response.message);
                            }, 500);
                        }
                    });
                });
        </script>
    </body>
</html>
