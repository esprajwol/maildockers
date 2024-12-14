@props(['name'])

<select name="{{ $name }}" {{ $attributes->merge([
    'class' => $errors->has($name) ? 'form-select is-invalid' : 'form-select'
]) }}>
    {{ $slot }}
</select>

@if ($errors->has($name))
    <div class="invalid-feedback">
        {{ $errors->first($name) }}
    </div>
@endif

