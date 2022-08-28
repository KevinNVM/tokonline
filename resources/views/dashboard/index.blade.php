@extends('dashboard.layouts.main')

@section('main')
    <div class="main p-3">

        @include('utilities.breadcrumb', ['title' => 'Dashboard'])

        <p>
            It's Now : {{ now()->format('d M Y') }}
            <i id="time"></i>
        </p>
    </div>

    <script src="/js/time.js"></script>
@endsection
