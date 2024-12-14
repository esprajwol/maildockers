@props([
    'type'          => 'text',
    'name',
    'placeholder'   => '',
    'value'         => '',
    'showError'     => true,
    'showDiv'       => true,
    'divClass'      => '',
    'showClass'     => false,
    "id"            => '',
    "isChecked"     => false,
    "hasIcon"       => false,
])

@if ($hasIcon) {{ $slot }} @endif
    <input id="{{ $id }}"
           type="{{ $type }}"
           name="{{ $name }}"
           value="{{ old($name, $value) }}"
           placeholder="{{ $placeholder }}"
           aria-label="{{ $placeholder }}"
           @if($isChecked) checked @endif
        {{ $attributes->class(['form-control' => ($type != 'checkbox' && $type != 'radio'), 'is-invalid' =>  $errors->has($name)]) }}
    />
@if (!$hasIcon) {{ $slot }} @endif

@if($showError)
    <x-form.error :name="$name"/>
@endif
