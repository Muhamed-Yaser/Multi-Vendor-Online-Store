@props([
    'name', 'options', 'checked' => false, 'label' => false,
])

@if($label)
    <label>{{ $label }}</label>
@endif

@foreach($options as $value => $text)
    <div class="form-check">
        <input class="form-check-input" type="radio" name="{{ $name }}" id="{{ $name . '_' . $value }}" value="{{ $value }}"
            @if(old($name, $checked) == $value) checked @endif
            {{ $attributes->merge(['class' => 'form-check-input', 'id' => $name . '_' . $value, 'is-invalid' => $errors->has($name)]) }}
        >
        <label class="form-check-label" for="{{ $name . '_' . $value }}">
            {{ $text }}
        </label>
    </div>
@endforeach
