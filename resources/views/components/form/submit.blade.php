@props([
    "text" => "Submit",
    "class" => null,
])


<button type="submit"
        {{ $attributes->merge(['class' => $class]) }}
        class="btn btn-primary">
{{--        class="btn btn-gradient-primary me-2">--}}
    {{ $text }}
</button>
{{--<button type="submit" class="btn btn-primary">{{ localize("Update Password") }}</button>--}}
