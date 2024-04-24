@extends("core::main")
@section("content")
@if($is_invalid)
    <section class="blog-details-hero set-bg" data-setbg="{{ asset("assets/img/breadcrumb.jpg") }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2>{{ $post->name }}</h2>
                        <ul>
                            {{-- <li>By Michael Scofield</li> --}}
                            <li>{{ $post->created_at->format("d-m-Y") }}</li>
                            <li>8 Bình luận</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<section class="blog-details spad">
    <div class="container">
        <div class="row">
            @include("post::pages.blogs.sider-bar", ["post_categories" => $post_categories, "post_news" => $post_news])

            <div class="col-lg-8 col-md-7 order-md-1 order-1">
            @if($is_invalid)
                <div class="blog__details__text">
                    <img src="img/blog/details/details-pic.jpg" alt="">
                    {!! $post->desc !!}
                </div>
                {{-- <div class="blog__details__content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="blog__details__author">
                                <div class="blog__details__author__pic">
                                    <img src="img/blog/details/details-author.jpg" alt="">
                                </div>
                                <div class="blog__details__author__text">
                                    <h6>Michael Scofield</h6>
                                    <span>Admin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="blog__details__widget">
                                <ul>
                                    <li><span>Categories:</span> Food</li>
                                    <li><span>Tags:</span> All, Trending, Cooking, Healthy Food, Life Style</li>
                                </ul>
                                <div class="blog__details__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="fb-comments" 
                    data-href="{{ url()->current() }}"
                    data-width="" 
                    data-numposts="5"
                ></div>
            @else
                Bài viết không tồn tại hoặc đã bị xóa
            @endif
            </div>
        </div>
    </div>
</section>

<section class="related-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related-blog-title">
                    <h2>Có thể bạn sẽ thích</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($post_related as $post)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="featured__item__pic">
                            <img src="{{ $post->image ? $post->image->url : asset("assets/img/img-default.jpg") }}" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li>
                                    <i class="fa fa-calendar-o"></i>
                                    {{ $post->created_at->format("d-m-Y") }}
                                </li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5>
                                <a href="{{ route("blogs.details", ["slug" => $post->slug ]) }}">{{ str()->limit($post->name, 30) }}</a>
                            </h5>
                            <p>{{ str()->limit($post->desc_sort, 90) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<div id="fb-root"></div>
@endsection

@push("js")
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v19.0&appId=362346932854219" nonce="n8pJ2pIj"></script>
@endpush