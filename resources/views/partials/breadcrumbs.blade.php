@if (count($breadcrumbs))
    <div class="breadcrumbs-block">
        <ul class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
            @foreach ($breadcrumbs as $breadcrumb)
                <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a class="breadcrumbs__link" href="{{ $breadcrumb->url }}" itemprop="item" {{ $loop->last ? 'aria-current="page"' : '' }}>
                        <span itemprop="name">
                            {{ $breadcrumb->title }}
                        </span>
                        <meta itemprop="position" content="{{ $loop->iteration }}">
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif

