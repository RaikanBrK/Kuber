@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-kuber-alert-error :text="$error" />
    @endforeach
@endif