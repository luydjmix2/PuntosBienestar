<br>
@php
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\URL;
@endphp
<a href="{{ URL::signedRoute('wellness-events-up-points', ['event_id' => Route::current()->parameter('id')]) }}" data-name="{{ $row->display_name }}" class="btn btn-primary" target="_blank">{{ $row->display_name }}</a>

