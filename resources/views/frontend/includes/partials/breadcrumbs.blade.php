{{-- @if (Breadcrumbs::has() && !Route::is('frontend.index')) --}}
@if (Breadcrumbs::has())
    <nav id="breadcrumbs" class="app-layout-breadcrumbs" aria-label="breadcrumb">
        <ol class="container breadcrumb mb-0">
            @foreach (Breadcrumbs::current() as $crumb)
                @if ($crumb->url() && !$loop->last)
                    <li class="breadcrumb-item">
                        <x-utils.link :href="$crumb->url()" :text="$crumb->title()" />
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $crumb->title() }}
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif

{{-- 
@if (Breadcrumbs::has())
    <nav id="breadcrumbs" aria-label="breadcrumb">
        <ol class="container breadcrumb mb-0">
            @foreach (Breadcrumbs::current() as $crumb)
                @if ($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $crumb->title() }}
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ $crumb->url() }}">{{ $crumb->title() }}</a>
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif --}}
