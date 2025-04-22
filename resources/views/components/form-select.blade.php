@props([
    'name',
    'label',
    'options' => [],
    'selected' => '',
    'placeholder' => 'Seleccione una opción',
    'required' => false
])

<div class="form-group row">
    <label for="{{ $name }}" class="col-sm-3 text-end control-label col-form-label">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-sm-9">
        <select 
            name="{{ $name }}" 
            id="{{ $name }}" 
            class="form-select @error($name) is-invalid @enderror"
            @if($required) required @endif
        >
            <option value="">{{ $placeholder }}</option>
            @foreach ($options as $value => $label)
                <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
