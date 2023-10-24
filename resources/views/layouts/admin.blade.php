@if (Auth::user()->isAdmin)
    @include('partials.admin')
@else
    @include('partials.user')
@endif
