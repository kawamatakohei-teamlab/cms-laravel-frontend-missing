@extends('layouts.common')

@section('main')
<main class="layout-base__main-center">
    <div class="layout-base__inner">
        <!-- mixinを定義-->
        <h2 class="heading-large heading-large--low js-scroll">
            <div class="heading-large__wrap">
            <div class="heading-large__text">Information</div>
            </div>
        </h2>
        <div class="js-scroll animation-slide-in-bottom">
            <div class="filter-list">
                <div class="filter-list__selected js-filter-list-open">ALL</div>
                <div class="filter-list__title">すべてのカテゴリ</div>
                <div class="filter-list__wrap">
                    <ul class="filter-list__list js-filter-information-list">
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category0" type="radio" name="category" value="" checked>
                            <label class="filter-list__label" for="category0">ALL</label>
                        </div>
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category1" type="radio" name="category" value="入試">
                            <label class="filter-list__label" for="category1">入試</label>
                        </div>
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category2" type="radio" name="category" value="お知らせ">
                            <label class="filter-list__label" for="category2">お知らせ</label>
                        </div>
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category3" type="radio" name="category" value="アート・展覧会">
                            <label class="filter-list__label" for="category3">アート・展覧会</label>
                        </div>
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category4" type="radio" name="category" value="演奏会・音楽会">
                            <label class="filter-list__label" for="category4">演奏会・音楽会</label>
                        </div>
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category5" type="radio" name="category" value="映像・映画・舞台">
                            <label class="filter-list__label" for="category5">映像・映画・舞台</label>
                        </div>
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category6" type="radio" name="category" value="出版">
                            <label class="filter-list__label" for="category6">出版</label>
                        </div>
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category7" type="radio" name="category" value="講演会・セミナー">
                            <label class="filter-list__label" for="category7">講演会・セミナー</label>
                        </div>
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category8" type="radio" name="category" value="受賞">
                            <label class="filter-list__label" for="category8">受賞</label>
                        </div>
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category9" type="radio" name="category" value="芸能活動（教員）">
                            <label class="filter-list__label" for="category9">芸能活動（教員）</label>
                        </div>
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category10" type="radio" name="category" value="芸能活動（学生・卒業生）">
                            <label class="filter-list__label" for="category10">芸能活動（学生・卒業生）</label>
                        </div>
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category11" type="radio" name="category" value="研究・産学連携">
                            <label class="filter-list__label" for="category11">研究・産学連携</label>
                        </div>
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category12" type="radio" name="category" value="国際交流">
                            <label class="filter-list__label" for="category12">国際交流</label>
                        </div>
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category13" type="radio" name="category" value="学内向け">
                            <label class="filter-list__label" for="category13">学内向け</label>
                        </div>
                    </ul>
                </div>
            </div>
            <ul class="information-list">
                <li class="information-list__item" data-category="[&quot;入試&quot;]"><a class="information-list__wrap" href="">
                    <div class="information-list__detail">
                        <div class="information-list__date-block">
                        <div class="information-list__category">
                            <div class="information-list__category-text">入試</div>
                        </div>
                        <div class="information-list__date">2018.01.18</div>
                        </div>
                        <div class="information-list__title"><span>Both Sides,Now 中西學・菅原一剛展</span></div>
                    </div>
                    <div class="information-list__image"><img class="information-list__image-img" src="http://placehold.jp/300x200.png" alt=""></div></a></li>
                <li class="information-list__item" data-category="[&quot;お知らせ&quot;]"><a class="information-list__wrap" href="">
                    <div class="information-list__detail">
                        <div class="information-list__date-block">
                        <div class="information-list__category">
                            <div class="information-list__category-text">カテゴリーカテゴリーカテゴリー</div>
                        </div>
                        <div class="information-list__date">2018.01.18</div>
                        </div>
                        <div class="information-list__title"><span>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</span></div>
                    </div>
                    <div class="information-list__image"><img class="information-list__image-img" src="http://placehold.jp/100x200.png" alt=""></div></a></li>
                <li class="information-list__item" data-category="[&quot;アート・展覧会&quot;]"><a class="information-list__wrap" href="">
                    <div class="information-list__detail">
                        <div class="information-list__date-block">
                        <div class="information-list__category">
                            <div class="information-list__category-text">アート・展覧会</div>
                        </div>
                        <div class="information-list__date">2018.01.18</div>
                        </div>
                        <div class="information-list__title"><span>Both Sides,Now 中西學・菅原一剛展</span></div>
                    </div>
                    <div class="information-list__image"><img class="information-list__image-img" src="http://placehold.jp/20x20.png" alt=""></div></a></li>
                <li class="information-list__item" data-category="[&quot;演奏会・音楽会&quot;]"><a class="information-list__wrap" href="">
                    <div class="information-list__detail">
                        <div class="information-list__date-block">
                        <div class="information-list__category">
                            <div class="information-list__category-text">演奏会・音楽会</div>
                        </div>
                        <div class="information-list__date">2018.01.18</div>
                        </div>
                        <div class="information-list__title"><span>Both Sides,Now 中西學・菅原一剛展</span></div>
                    </div>
                    <div class="information-list__image"><img class="information-list__image-img" src="http://placehold.jp/500x500.png" alt=""></div></a></li>
                <li class="information-list__item" data-category="[&quot;映像・映画・舞台&quot;]"><a class="information-list__wrap" href="">
                    <div class="information-list__detail">
                        <div class="information-list__date-block">
                        <div class="information-list__category">
                            <div class="information-list__category-text">映像・映画・舞台</div>
                        </div>
                        <div class="information-list__date">2018.01.18</div>
                        </div>
                        <div class="information-list__title"><span>Both Sides,Now 中西學・菅原一剛展</span></div>
                    </div>
                    <div class="information-list__image"><img class="information-list__image-img" src="http://placehold.jp/300x200.png" alt=""></div></a></li>
                <li class="information-list__item" data-category="[&quot;出版&quot;]"><a class="information-list__wrap" href="">
                    <div class="information-list__detail">
                        <div class="information-list__date-block">
                        <div class="information-list__category">
                            <div class="information-list__category-text">出版</div>
                        </div>
                        <div class="information-list__date">2018.01.18</div>
                        </div>
                        <div class="information-list__title"><span>Both Sides,Now 中西學・菅原一剛展</span></div>
                    </div>
                    <div class="information-list__image"><img class="information-list__image-img" src="http://placehold.jp/300x200.png" alt=""></div></a></li>
                <li class="information-list__item" data-category="[&quot;講演会・セミナー&quot;]"><a class="information-list__wrap" href="">
                    <div class="information-list__detail">
                        <div class="information-list__date-block">
                        <div class="information-list__category">
                            <div class="information-list__category-text">講演会・セミナー</div>
                        </div>
                        <div class="information-list__date">2018.01.18</div>
                        </div>
                        <div class="information-list__title"><span>Both Sides,Now 中西學・菅原一剛展</span></div>
                    </div>
                    <div class="information-list__image"><img class="information-list__image-img" src="http://placehold.jp/300x200.png" alt=""></div></a></li>
                <li class="information-list__item" data-category="[&quot;受賞&quot;]"><a class="information-list__wrap" href="">
                    <div class="information-list__detail">
                        <div class="information-list__date-block">
                        <div class="information-list__category">
                            <div class="information-list__category-text">受賞</div>
                        </div>
                        <div class="information-list__date">2018.01.18</div>
                        </div>
                        <div class="information-list__title"><span>Both Sides,Now 中西學・菅原一剛展</span></div>
                    </div>
                    <div class="information-list__image"><img class="information-list__image-img" src="http://placehold.jp/300x200.png" alt=""></div></a></li>
                <li class="information-list__item" data-category="[&quot;芸能活動（教員）&quot;]"><a class="information-list__wrap" href="">
                    <div class="information-list__detail">
                        <div class="information-list__date-block">
                        <div class="information-list__category">
                            <div class="information-list__category-text">芸能活動（教員）</div>
                        </div>
                        <div class="information-list__date">2018.01.18</div>
                        </div>
                        <div class="information-list__title"><span>Both Sides,Now 中西學・菅原一剛展</span></div>
                    </div>
                    <div class="information-list__image"><img class="information-list__image-img" src="http://placehold.jp/300x200.png" alt=""></div></a></li>
                <li class="information-list__item" data-category="[&quot;芸能活動（学生・卒業生）&quot;]"><a class="information-list__wrap" href="">
                    <div class="information-list__detail">
                        <div class="information-list__date-block">
                        <div class="information-list__category">
                            <div class="information-list__category-text">芸能活動（学生・卒業生）</div>
                        </div>
                        <div class="information-list__date">2018.01.18</div>
                        </div>
                        <div class="information-list__title"><span>Both Sides,Now 中西學・菅原一剛展</span></div>
                    </div>
                    <div class="information-list__image"><img class="information-list__image-img" src="http://placehold.jp/300x200.png" alt=""></div></a></li>
                <li class="information-list__item" data-category="[&quot;研究・産学連携&quot;]"><a class="information-list__wrap" href="">
                    <div class="information-list__detail">
                        <div class="information-list__date-block">
                        <div class="information-list__category">
                            <div class="information-list__category-text">研究・産学連携</div>
                        </div>
                        <div class="information-list__date">2018.01.18</div>
                        </div>
                        <div class="information-list__title"><span>Both Sides,Now 中西學・菅原一剛展</span></div>
                    </div>
                    <div class="information-list__image"><img class="information-list__image-img" src="http://placehold.jp/300x200.png" alt=""></div></a></li>
                <li class="information-list__item" data-category="[&quot;国際交流&quot;]"><a class="information-list__wrap" href="">
                    <div class="information-list__detail">
                        <div class="information-list__date-block">
                        <div class="information-list__category">
                            <div class="information-list__category-text">国際交流</div>
                        </div>
                        <div class="information-list__date">2018.01.18</div>
                        </div>
                        <div class="information-list__title"><span>Both Sides,Now 中西學・菅原一剛展</span></div>
                    </div>
                    <div class="information-list__image"><img class="information-list__image-img" src="http://placehold.jp/300x200.png" alt=""></div></a></li>
                <li class="information-list__item" data-category="[&quot;学内向け&quot;]"><a class="information-list__wrap" href="">
                    <div class="information-list__detail">
                        <div class="information-list__date-block">
                        <div class="information-list__category">
                            <div class="information-list__category-text">学内向け</div>
                        </div>
                        <div class="information-list__date">2018.01.18</div>
                        </div>
                        <div class="information-list__title"><span>Both Sides,Now 中西學・菅原一剛展</span></div>
                    </div>
                    <div class="information-list__image"><img class="information-list__image-img" src="http://placehold.jp/300x200.png" alt=""></div></a></li>
            </ul>
            <div class="pagination">
                <button class="pagination__arrow pagination__arrow--prev" type="button"><span></span></button>
                <button class="pagination__item pagination__item--first" type="button">1</button>
                <div class="pagination__omit"><span></span></div>
                <button class="pagination__item" type="button">3</button>
                <button class="pagination__item" type="button">4</button>
                <div class="pagination__item pagination__item--current">5</div>
                <button class="pagination__item" type="button">6</button>
                <button class="pagination__item" type="button">7</button>
                <div class="pagination__omit"><span></span></div>
                <button class="pagination__item pagination__item--last" type="button">18</button>
                <button class="pagination__arrow pagination__arrow--next" type="button"><span></span></button>
            </div>
        </div>
    </div>
</main>
@endsection
