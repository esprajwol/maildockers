@props([
'type'          => 'text',
'name'          => '',
'placeholder'   => '',
'value'         => '',
"id"            => '',
])
<textarea  id="{{ $id }}"
           type="{{ $type }}"
           name="{{ $name }}"
           value="{{ old($name, $value) }}"
           placeholder="{{ $placeholder }}"
           {{ $attributes->merge(['class' => 'form-control']) }}>{{ $slot }}
               </textarea>

