<div>
    <x-form.label>{{ localize($label) }}</x-form.label>
    <x-form.input type="file" name="{{ $name }}[]" multiple/>
</div>
{{--@props([
"label" => "Upload File",
"name" => "image_file",
"for" => "imageFile",
"accept" => "image/*",
"multiple" => "multiple",
])

<x-form.label for="{{ $for }}">{{ localize($label) }}</x-form.label>
<x-form.input type="file"
              id="{{ $for }}"
              name="{{ $name }}[]"
              accept="{{ $accept }}"
              value="{{ old('file') }}" multiple
/>

<x-form.error :name="$name"/>--}}
