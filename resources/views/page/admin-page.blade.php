@push('styles')
    <link rel="stylesheet" href="{{asset('css/admin.min.css?v=').time()}}">
@endpush
@extends('/index')
@section('content')
    <main class="main">
        <div class="admin-content">
            @include('page.admin.aside-admin')
            @yield('admin-content')
        </div>
    </main>
@endsection
