@props([
    "label" => "Upload File",
    "name" => "image_file",
    "for" => "imageFile",
    "accept" => "image/*",
])

<x-form.label for="{{ $for }}">{{ localize($label) }}</x-form.label>
<x-form.input type="file"
              id="{{ $for }}"
              name="{{ $name }}"
              accept="{{ $accept }}"
              value="{{ old('image') }}"
/>

<x-form.error :name="$name"/>
