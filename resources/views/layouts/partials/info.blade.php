@if ($errors->any())
    <window-alert type=error array-message='{{ json_encode($errors->all()) }}'></window-alert>
@endif

@if(session()->has('success'))
    <window-alert type=success one-message='{{ session()->get('success') }}'></window-alert>
@endif