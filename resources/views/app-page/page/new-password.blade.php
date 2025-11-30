@push('styles')
    <link rel="stylesheet" href="{{asset('css/admin.min.css?v=').time()}}">
@endpush
@extends('/index')
@section('content')
<main class="main">
    <div class="main-content">
        <section class="form-wrap">
            <div class="form-title">
                Новый пароль
            </div>
            <form class="form js-response" method="POST" action="{{ route('api.v1.new.password') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-block form-block-alt">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" hidden required autocomplete="email" autofocus>
                    <div class="input-wrap" data-notification="Вывод ошибки">
                        <label class="input-label" for="surname">*Новый пароль</label>
                        <input class="input" name="password" id="surname" required type="password"/>
                    </div>

                    <div class="input-wrap passwordError" data-notification="Вывод ошибки">
                        <label class="input-label" for="name">*Подтверждение нового пароля</label>
                        <input class="input" name="password_confirmation" id="name" required type="password"/>
                    </div>
                </div>

                <div class="form-block">

                    <div class="wrap-button js-button">
                        <button class="button">Сохранить</button>
                    </div>

                    <div class="wrap-pop-up-button js-preloader hide">
                        <div class="wrap-spin ">
                            <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                        </div>
                        <article>Обработка</article>
                    </div>
                </div>
            </form>
        </section>
    </div>
</main>
@endsection
