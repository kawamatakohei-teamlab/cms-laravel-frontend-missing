@extends('layouts.common')

@section('main')
<main class="layout-base__main-center">
  <div class="layout-base__inner">
    <!-- mixinを定義-->
              <h2 class="heading-large-white heading-large-white--low js-scroll">
                <div class="heading-large-white__wrap">
                  <div class="heading-large-white__text">教員一覧</div>
                </div>
              </h2>
    <div class="js-scroll animation-slide-in-bottom">
      <div class="filter-list">
        <div class="filter-list__selected js-filter-list-open">ALL</div>
        <div class="filter-list__title">すべてのカテゴリ</div>
        <div class="filter-list__wrap">
          <ul class="filter-list__list js-filter-name-list">
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category0" type="radio" name="category" value="" checked>
                                <label class="filter-list__label" for="category0">ALL</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category1" type="radio" name="category" value="アートサイエンス学科">
                                <label class="filter-list__label" for="category1">アートサイエンス学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category2" type="radio" name="category" value="美術学科">
                                <label class="filter-list__label" for="category2">美術学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category3" type="radio" name="category" value="デザイン学科">
                                <label class="filter-list__label" for="category3">デザイン学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category4" type="radio" name="category" value="工芸学科">
                                <label class="filter-list__label" for="category4">工芸学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category5" type="radio" name="category" value="写真学科">
                                <label class="filter-list__label" for="category5">写真学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category6" type="radio" name="category" value="建築学科">
                                <label class="filter-list__label" for="category6">建築学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category7" type="radio" name="category" value="映像学科">
                                <label class="filter-list__label" for="category7">映像学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category8" type="radio" name="category" value="キャラクター造形学科">
                                <label class="filter-list__label" for="category8">キャラクター造形学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category9" type="radio" name="category" value="文芸学科">
                                <label class="filter-list__label" for="category9">文芸学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category10" type="radio" name="category" value="放送学科">
                                <label class="filter-list__label" for="category10">放送学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category11" type="radio" name="category" value="芸術計画学科">
                                <label class="filter-list__label" for="category11">芸術計画学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category12" type="radio" name="category" value="舞台芸術学科">
                                <label class="filter-list__label" for="category12">舞台芸術学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category13" type="radio" name="category" value="音楽学科">
                                <label class="filter-list__label" for="category13">音楽学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category14" type="radio" name="category" value="演奏学科">
                                <label class="filter-list__label" for="category14">演奏学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category15" type="radio" name="category" value="初等芸術教育学科">
                                <label class="filter-list__label" for="category15">初等芸術教育学科</label>
                              </div>
                              <div class="li filter-list__item">
                                <input class="filter-list__input" id="category16" type="radio" name="category" value="教養科目・専門関連科目">
                                <label class="filter-list__label" for="category16">教養科目・専門関連科目</label>
                              </div>
          </ul>
        </div>
      </div>
      <!-- mixinを定義-->
                  <h3 class="heading-middle">
                    <div class="heading-middle__text">教授</div>
                  </h3>
      <div class="name-list">
        <div class="name-list__item" data-category="[&quot;アートサイエンス学科&quot;]"><a class="name-list__wrap" href="">
            <div class="link-external"><span class="name-list__text">山田 太郎</span></div></a></div>
        <div class="name-list__item" data-category="[&quot;美術学科&quot;]"><a class="name-list__wrap" href="">
            <div class="link-external"><span class="name-list__text">山田 太郎</span></div></a></div>
        <div class="name-list__item" data-category="[&quot;デザイン学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田山田山田山田 太郎太郎太郎太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;工芸学科&quot;]"><a class="name-list__wrap" href="">
            <div class="link-external"><span class="name-list__text">山田 太郎</span></div></a></div>
        <div class="name-list__item" data-category="[&quot;デザイン学科&quot;, &quot;写真学科&quot;]"><a class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div></a></div>
        <div class="name-list__item" data-category="[&quot;建築学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;建築学科&quot;, &quot;映像学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;キャラクター造形学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;文芸学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;放送学科&quot;]"><a class="name-list__wrap" href="">
            <div class="link-external"><span class="name-list__text">山田山田山田山田 太郎太郎太郎太郎</span></div></a></div>
        <div class="name-list__item" data-category="[&quot;芸術計画学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;舞台芸術学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;音楽学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;演奏学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;初等芸術教育学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;教養科目・専門関連科目&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
      </div>
      <!-- mixinを定義-->
                  <h3 class="heading-middle">
                    <div class="heading-middle__text">准教授</div>
                  </h3>
      <div class="name-list">
        <div class="name-list__item" data-category="[&quot;アートサイエンス学科&quot;]"><a class="name-list__wrap" href="">
            <div class="link-external"><span class="name-list__text">山田 太郎</span></div></a></div>
        <div class="name-list__item" data-category="[&quot;美術学科&quot;]"><a class="name-list__wrap" href="">
            <div class="link-external"><span class="name-list__text">山田 太郎</span></div></a></div>
        <div class="name-list__item" data-category="[&quot;デザイン学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田山田山田山田 太郎太郎太郎太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;工芸学科&quot;]"><a class="name-list__wrap" href="">
            <div class="link-external"><span class="name-list__text">山田 太郎</span></div></a></div>
        <div class="name-list__item" data-category="[&quot;デザイン学科&quot;, &quot;写真学科&quot;]"><a class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div></a></div>
        <div class="name-list__item" data-category="[&quot;建築学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;建築学科&quot;, &quot;映像学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;キャラクター造形学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;文芸学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;アートサイエンス学科&quot;, &quot;放送学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田山田山田山田 太郎太郎太郎太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;芸術計画学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;舞台芸術学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;アートサイエンス学科&quot;, &quot;音楽学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;演奏学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
        <div class="name-list__item" data-category="[&quot;初等芸術教育学科&quot;]">
          <div class="name-list__wrap">
            <div class="name-list__text"><span>山田 太郎</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection