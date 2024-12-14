
    <textarea id="{{ $id }}" name="{{ $name }}">{{ $slot }}</textarea>

    <script>
        tinymce.init({
            selector: '#{{ $id }}',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            height: 300
        });
    </script>
