@extends('/index')
@section('content')
    <div class="main-content">
        <section class="form-wrap">
            <div class="catalog-title">
                Каталог
            </div>
            <section class="catalog-grid">
                <ul class="catalog-grid-list">
                    @foreach($categories as $category)
                        <li class="content-grid-item">
                            <a class="catalog-box-link" href="{{route('show.category', $category->id)}}">
                                <div class="content-img-back-wrap">
                                    <img class="content-grid-img" src="{{asset($category->link)}}" alt="fadvis">
                                </div>
                                <div class="filter-catalog left-content ">
                                    <div class="filter-item-catalog">
                                        <div class="catalog-link catalog-link-center">{{$category->name}}</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        </section>
    </div>
@endsection
