<div class="col-lg-4 col-md-5">
    <div class="blog__sidebar">
        <div class="blog__sidebar__search">
            <form action="#">
                <input type="text" placeholder="Tìm kiếm">
                <button type="submit">
                    <span class="icon_search"></span>
                </button>
            </form>
        </div>
        <div class="blog__sidebar__item">
            <h4>Danh mục</h4>
            <ul>
                <li><a href="{{ route("blogs") }}">Tất cả</a></li>
                @foreach ($post_categories as $category)
                    <li>
                        <a href="{{ route("blogs", ["category" => $category->slug]) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="blog__sidebar__item">
            <h4>Mới nhất</h4>
            <div class="blog__sidebar__recent">
                @foreach ($post_news as $post)
                    <a href="{{ route("blogs.details", ["slug" => $post->slug]) }}" class="blog__sidebar__recent__item">
                        <div class="blog__sidebar__recent__item__pic">
                            <img src="{{ $post->image ? $post->image->url : asset("assets/img/img-default.jpg") }}" alt="">
                        </div>
                        <div class="blog__sidebar__recent__item__text">
                            <h6>
                                <span class="text-dark">{{ $post->name }}</span>
                                <span>{{ $post->category->name }}</span>
                            </h6>
                            <span>{{ $post->created_at->format("d-m-Y") }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>