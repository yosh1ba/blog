<!-- ヘッダー -->
<?php get_header(); ?>

<!-- メニュー -->
<?php get_template_part('content', 'menu'); ?>

<!-- メインコンテンツ -->
    <section class="breadcrumbs">
        <div class="wrapper">
        <p class="breadcrumbs-item">
        <?php bcn_display(); //BreadcrumbNavXTのパンくずを表示するための記述 ?>
        </p>
        </div>
        </section>
        <section id="main">
            <div class="wrapper">
                <div class="contents d-flex">
                    <article class="entry-single">
                        <a class="entry-category">
                            <!-- カテゴリーの一つ目を表示 -->
                            <?php my_the_post_category( false ); ?>
                        </a>
                        <h1 class="entry-header-1"><?php the_title(); ?></h1>
                        <div class="entry-date d-flex">
                            <p class="p-small"><i class="far fa-calendar-alt"></i><span class="d-none-sp">投稿日：</span><?php the_time("Y年m月d日"); ?></p>
                            <p class="p-small"><i class="far fa-edit"></i><span class="d-none-sp"> 更新日：</span><?php the_modified_time("Y年m月d日");?></p>
                        </div>
                        <div class="entry-img-area">
                        <?php
                            if (has_post_thumbnail() ) {
                                // アイキャッチ画像が設定されてれば大サイズで表示
                                the_post_thumbnail('large', array('class' => 'entry-thumbnail'));
                                } else {
                                // なければnoimage画像をデフォルトで表示
                                echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/thumbnail.jpg" alt="" class="entry-thumbnail-none">';
                            }
                        ?>
                        </div>
                        <?php the_post(); ?>
                        <?php
                        //本文の表示
                        the_content(); ?>
                        <?php
                        //改ページを有効にするための記述
                        wp_link_pages(
                            array(
                            'before' => '<nav class="entry-links">',
                            'after' => '</nav>',
                            'link_before' => '',
                            'link_after' => '',
                            'next_or_number' => 'number',
                            'separator' => '',
                            )
                        );
                        ?>
                        <!-- <div class="entry-more">
                            <a href="">Googole Books APIを使用して初期情報を検索する</a>
                            <a href="">Googole Books APIを使用して初期情報を検索する</a>
                        </div> -->
                        <hr class="hr-narrow-solid mt-30">
                        <div class="entry-tags d-flex">
                            <!-- タグ一覧を出力 -->
                            <?php my_the_post_tag(); ?>
                        </div>
                        <div class="entry-sns d-flex">
                            <?php
                            $share_url   = get_permalink();
                            $share_title = get_the_title();
                            ?>
                            <div href="" class="sns-btn twitter">
                                <i class="fab fa-twitter"></i>
                                <a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" title="Twitterでシェア" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');return false;"></a>
                            </div>
                            <div href="" class="sns-btn facebook">
                                <i class="fab fa-facebook-f"></i>
                                <a href="https://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="Facebookでシェア" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=600');return false;"></a>
                            </div>
                            <div href="" class="sns-btn line">
                                <i class="fab fa-line"></i>
                                <a href="//line.me/R/msg/text/?<?=$share_title.'%0A'.$share_url?>" target="_blank" title="LINEに送る"></a>
                            </div>
                            <div href="" class="sns-btn pocket">
                                <i class="fab fa-get-pocket"></i>
                                <a href="//getpocket.com/edit?url=<?=$share_url?>&title=<?=$share_title?>" target="_blank" title="Pocketに保存する"></a>
                              </div>
                        </div>
                        <div class="relation-entry">
                            <h3 class="relation-entry-header">関連記事</h3>
                            <div class="d-flex">
                                <?php
                                if(has_category()) {
                                    
                                    $post_cats = get_the_category();
                                    $cat_ids = array();

                                    foreach($post_cats as $cat){
                                        $cat_ids[] = $cat->term_id;
                                    }
                                }

                                $myposts = get_posts(array(
                                    'post_type' => 'post',  // 投稿タイプ
                                    'category__in' => $cat_ids, // 同じカテゴリID
                                    'posts_per_page' => 3,  // 3件まで取得
                                    'orderby' => 'rand',    // 並びはランダム
                                    'exclude' => get_the_ID()   // 現在の投稿は除く
                                ));

                                if($myposts) : ?>

                                <?php foreach($myposts as $post): setup_postdata($post); ?>
                                <div class="relation-entry-detail">
                                    <?php
                                    if (has_post_thumbnail() ) {
                                        // アイキャッチ画像が設定されてればサムネイルサイズで表示
                                        the_post_thumbnail('thumbnail', array('class' => 'relation-entry-thumbnail'));
                                        } else {
                                        // なければnoimage画像をデフォルトで表示
                                        echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/thumbnail.jpg" alt="" class="relation-entry-thumbnail">';
                                    }
                                    ?>
                                    <h4><?php the_title(); ?></h4>
                                    <a href="<?php the_permalink(); ?>"></a>
                                </div>
                                <?php endforeach; wp_reset_postdata(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                    

        <!-- サイドバー -->
        <?php get_sidebar(); ?>

        </div>
    </div>
</section>

<!-- フッター -->
<?php get_footer(); ?>