<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Footer</title>
    <style>
        .pdf-page-footer {
            text-align: center;
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #7a7a7a;
        }

        .title {
            font-weight: bold;
        }
    </style>
    <script>
        function substitutePdfVariables() {

            function getParameterByName(name) {
                var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
                return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
            }

            function substitute(name) {
                var value = getParameterByName(name);
                var elements = document.getElementsByClassName(name);

                for (var i = 0; elements && i < elements.length; i++) {
                    elements[i].textContent = value;
                }
            }

            ['frompage', 'topage', 'page', 'webpage', 'section', 'subsection', 'subsubsection']
                .forEach(function(param) {
                    substitute(param);
                });
        }
    </script>
</head>
<body onload="substitutePdfVariables()">
<div class="pdf-page-footer">
    <h3 class="title">- <span class="page"></span> of <span class="topage"></span> -</h3>
</div>
</body>
</html>
