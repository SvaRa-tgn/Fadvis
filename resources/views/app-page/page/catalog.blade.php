@extends('/index')
@section('content')
    <div class="main-content for-phone">
        <div class="page-title">
            Каталог
        </div>
        <section class="main-content-bottom">
            <ul class="catalog-list position-column-3">
                @foreach($categories as $category)
                    <li class="catalog-item index-page">
                        <a class="wrap-catalog-item" href="{{route('show.category', $category['slug'])}}">
                            <img class="item-img" src="{{asset($category['link'])}}" alt="Fadvis">
                            <div class="filter for-catalog">
                                <div class="filter-box">
                                    <article class="filter-article">
                                        {{$category['name']}}
                                    </article>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
@endsection
