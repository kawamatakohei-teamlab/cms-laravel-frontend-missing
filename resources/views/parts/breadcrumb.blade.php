@section('breadcrumb')
<div class="c-breadcrumb">
  <div class="c-breadcrumb__in">
  @foreach ($breadcrumbs as $breadcrumb)
    @if($loop->last)
        <span class="c-breadcrumb__item"><span class="c-breadcrumb__text">{{ $breadcrumb['title']}}</span></span>           
    @else
        <span class="c-breadcrumb__item"><a class="c-breadcrumb__link" href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a></span>  
    @endif
  @endforeach
  </div>
</div>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement":
  [
    @foreach ($breadcrumbs as $breadcrumb)
    {
      "@type": "ListItem",
      "position": {{ $loop->index }},
      "item":
      {
        "@id": "{{ $breadcrumb['url'] }}",
        "name": "{{ $breadcrumb['title']}}"
      }
    } @if(!$loop->last){{ "," }}@endif
    @endforeach
  ]
}
</script>
@endsection