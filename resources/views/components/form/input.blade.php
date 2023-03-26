<div class="form-group {{ $formGroupClass }}">
    <label for="{{ $name }}">{{ ucfirst($label) }}</label>
    <input type="{{ $type }}" class="form-control {{ $class }} @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}">
    @error($name) 
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>