<?php

// 1.独自テーマのセットアップ関数
function my_setup()
{
    add_theme_support('post-thumbnails'); // アイキャッチ画像を有効化
    add_theme_support('automatic-feed-links'); // 投稿とコメントのRSSフィードのリンクを有効化
    add_theme_support('title-tag'); // タイトルタグ自動生成
    add_theme_support(
        'html5',
        array( //HTML5でマークアップ
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )
    );
}

// 2.スクリプトファイルを読み込むための関数
function my_files(){
    // WordPress本体のjQueryを読み込まない
    wp_deregister_script('jquery');

    // jQueryの読み込み
    wp_enqueue_script( 'jQuery', get_template_directory_uri().'/js/jquery-3.4.1.min.js',array() , "20200119",true);
    // 共通スクリプトの読み込み
    wp_enqueue_script( 'script', get_template_directory_uri().'/js/script.js', array('jQuery'), "20200119",true);
    // FontAwesome読み込み
    wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/095cff189b.js', array(), '',false);

    // スタイルの読み込み
    wp_enqueue_style( 'style', get_stylesheet_uri(), array(), "20200119");
    // GoogleFont読み込み
    wp_enqueue_style( 'g-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,700|Noto+Sans+JP:400,700&display=swap&subset=japanese', array(), "20190119");
    
}

// 3.FontAwesomeにcrossoriginを追記するための関数
function custom_script_loader_tag($tag, $handle){
    if($handle != 'fontawesome'){
        return $tag;
    }else {
        return str_replace('></script>', ' crossorigin="anonymous"></script>',$tag);
    }
}

// 4.ナビゲーションメニューを表示させるための関数
function my_menu_init(){
    register_nav_menus(
        array(
            'place_global' => 'グローバルナビ',
            'place_footer' => 'フッターナビ',
        )
    );
}

/**
* 5.アーカイブタイトル書き換え
*
* @param string $title 書き換え前のタイトル.
* @return string $title 書き換え後のタイトル.
*/
function my_archive_title( $title ) {

    if ( is_category() ) { // カテゴリーアーカイブの場合
        $title = '' . single_cat_title( '', false ) . '';
    } elseif ( is_tag() ) { // タグアーカイブの場合
        $title = '' . single_tag_title( '', false ) . '';
    } elseif ( is_post_type_archive() ) { // 投稿タイプのアーカイブの場合
        $title = '' . post_type_archive_title( '', false ) . '';
    } elseif ( is_tax() ) { // タームアーカイブの場合
        $title = '' . single_term_title( '', false );
    } elseif ( is_author() ) { // 作者アーカイブの場合
        $title = '' . get_the_author() . '';
    } elseif ( is_date() ) { // 日付アーカイブの場合
        $title = '';
        if ( get_query_var( 'year' ) ) {
            $title .= get_query_var( 'year' ) . '年';
        }
        if ( get_query_var( 'monthnum' ) ) {
            $title .= get_query_var( 'monthnum' ) . '月';
        }
        if ( get_query_var( 'day' ) ) {
            $title .= get_query_var( 'day' ) . '日';
        }
    }
    return $title;
};

// 6.ウィジェットを表示させるための関数
function my_widget_init() {
    register_sidebar(
        array(
            'name' => 'サイドバー', //表示するエリア名
            'id' => 'sidebar', //id
            'before_widget' => '<div id="%1$s" class="widget %2$s sidebar-content">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title normal">',
            'after_title' => '</div>',
        )
    );
}


// 7.検索結果から固定ページを除外する
// @param string $search SQLのWHERE句の検索条件文
// @param object $wp_query WP_Queryのオブジェクト
// @return string $search 条件追加後の検索条件文
function my_posts_search( $search, $wp_query ){

    //検索結果ページ・メインクエリ・管理画面以外の3つの条件が揃った場合
    if ( $wp_query->is_search() && $wp_query->is_main_query() && !is_admin() ){

        // 検索結果を投稿タイプに絞る
        $search .= " AND post_type = 'post' ";

        return $search;
    }

    return $search;

}

// カテゴリ名を表示
function my_the_post_category($id = 0){
    global $post;

    if($id === 0 ){
        $id = $post->ID;
    }

    $this_categories = get_the_category($id);
    if($this_categories[0]){
        echo esc_html($this_categories[0]->cat_name);
    }
}

// タグ一覧を表示
function my_the_post_tag($id = 0){
    global $post;

    if($id === 0){
        $id = $post->ID;
    }

    $this_tags = get_the_tags($id);

    if($this_tags){
        foreach($this_tags as $tag){
            echo '<div class="tag-item">';
            echo '<span><i class="fas fa-tags"></i>'. esc_html( $tag->name ) .'</span>';
            echo '<a href="'. esc_url( get_tag_link($tag->term_id)) .'"></a>';
            echo '</div>';
        }
    }
}

// 1.独自テーマを適用するためのアクションフック
add_action('after_setup_theme', 'my_setup');

// 2.FontAwesomeの呼び出し構文にcrossoriginを追記するためのフィルターフック
add_filter('script_loader_tag', 'custom_script_loader_tag', 10, 2);

// 3.スクリプトファイルを読み込むためのアクションフック
add_action('wp_enqueue_scripts', 'my_files');

// 4.ナビゲーションメニューを表示させるためのアクションフック
add_action('init', 'my_menu_init');

// 5.アーカイブタイトルを書き換えるためのフック
add_filter( 'get_the_archive_title', 'my_archive_title' );

// 6.ウィジェットを有効化するためのフック
add_action( 'widgets_init', 'my_widget_init' );

// 7.検索結果に固定ページを含まない
add_filter('posts_search','my_posts_search', 10, 2);

// excerpt（本文要約）に自動挿入されるpタグを削除する
// フックのみで関数は無い
remove_filter('the_excerpt', 'wpautop');



