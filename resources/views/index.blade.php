@include('main-block.head')
@include('pop-up.auth-pop-up')
@include('pop-up.notification-box')
@include('pop-up.change-password')
@include('pop-up.new-patient')
@include('pop-up.wait-box')
<main>
    @yield('content')
</main>
@include('main-block.footer')


