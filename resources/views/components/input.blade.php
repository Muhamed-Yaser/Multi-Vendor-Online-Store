@props([
    'type' => 'text',
    'id' => '',
    'name' => '',
    'value' => '',
    'label' => '',
])
<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" value="{{ old($name,$value) }}">
    @error($name)
        <div class="alert alert-danger" style='width:27%; text-align:center;margin:.3%'>{{ $message }}</div>
    @enderror
</div>
