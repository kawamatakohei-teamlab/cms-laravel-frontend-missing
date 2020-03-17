<?php
/**
 * パンくず設定
 */

 // top_page
Breadcrumbs::for('topPage', function ($trail) {
    $trail->push('ホーム', route('top.index'));
});

// お知らせ
Breadcrumbs::for('whatsNewIndex', function ($trail) {
    $trail->parent('topPage');
    $trail->push('お知らせ一覧', route('whats_new_index'));
});

Breadcrumbs::for('whatsNewShow', function ($trail, $infoArticle) {
    $trail->parent('whatsNewIndex');
    $trail->push($infoArticle->title, route('whats_new_show', ['key' => $infoArticle->permalink]));
});

// 施設案内
Breadcrumbs::for('guideFacilityShow', function ($trail, $facilityArticle) {
    $trail->parent('topPage');
    $trail->push($facilityArticle->title, route('guide_facility_show', ['permalink' => $facilityArticle->permalink]));
});

// Topics
Breadcrumbs::for('topicIndex', function ($trail) {
    $trail->parent('topPage');
    $trail->push('Topics', route('topic_index'));
});

Breadcrumbs::for('topicShow', function ($trail, $topicArticle) {
    $trail->parent('topicIndex');
    $trail->push(strip_tags($topicArticle->title), route('topic_show', ['permalink' => $topicArticle->permalink]));
});

// 教員一覧
Breadcrumbs::for('teacherIndex', function ($trail) {
    $trail->parent('topPage');
    $trail->push('教員一覧', route('teacher_index'));
});

// 学科一覧
Breadcrumbs::for('departmentIndex', function ($trail) {
    $trail->parent('topPage');
    $trail->push('学科一覧', route('department_index'));
});
