{{--<div>
    <input type="file" name="{{ $name }}[]" multiple>
</div>--}}
@props([
"label" => "Upload File",
"name" => "image_file",
"for" => "imageFile",
"accept" => "image/*",
"multiple" => "multiple",
])

<x-form.label for="{{ $for }}">{{ localize($label) }}</x-form.label>
<x-form.input type="file"
              id="{{ $for }}"
              name="{{ $name }}"
              accept="{{ $accept }}"
              value="{{ old('image') }}" multiple
/>

<x-form.error :name="$name"/>
