<div class="form-group {{ $formGroup }}">
    <label for="{{ $name }}">
        <span class="sr-only">{{ $label }}</span>
        <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" aria-describedby="{{ $description }}" placeholder="{{ $placeholder }}" value="{{ $value }}">
        <i class="fas fa-{{ $icon }} icon"></i>
    </label>
    @error($name)
        <p class="text-muted pl-2">{{ $message }}</p>
    @enderror
</div>