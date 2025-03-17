@props(['name',
     'value' => '', 
    'type' => 'text'])

<input 
    type="{{ $type }}" 
    name="{{ $name }}" 
    value="{{ old($name, $value) }}"
    @class(
    ['form-control', 
    'is-invalid' => $errors->has($name)])>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror