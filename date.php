<!-- ヘッダー -->
<?php get_header(); ?>

<!-- メニュー -->
<?php get_template_part('content', 'menu'); ?>

<!-- メインコンテンツ -->

<!-- パンくずリスト -->
<?php get_template_part('content', 'breadcrumbs'); ?>

<section id="main">
<div class="wrapper">
    <div class="contents d-flex">
        <article class="entry">
            <p>Date</p>
            <p class="bold"><?php the_archive_title(); ?></p>
            <hr class="hr-wide-solid">
            <hr class="hrnarrow--dotted top">
            <div id="posts">
                <!-- 記事の一覧表示 -->
                <?php if(have_posts()): ?>
                    <?php while(have_posts()) : the_post();?>
                    <div href="" class="post-content d-flex">
                        <div class="post-content-left">
                            <?php
                            if (has_post_thumbnail() ) {
                                // アイキャッチ画像が設定されてれば大サイズで表示
                                the_post_thumbnail('thumbnail', array('class' => 'post-thumnail'));
                                } else {
                                // なければnoimage画像をデフォルトで表示
                                echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/thumbnail.jpg" alt="" class="post-thumnail">';
                            }
                            ?>
                            <span class="category-one p-small">
                            <!-- カテゴリーの一つ目を表示 -->
                            <?php my_the_post_category(); ?>
                            </span>
                        </div>
                        <div class="post-content-right">
                            <h2 class="post-content-header"><?php the_title(); ?></h2>
                            <div class="post-content-date d-flex">
                                <p class="p-small"><i class="far fa-calendar-alt"></i><?php the_time("Y年m月d日"); ?></p>
                                <p class="p-small"><i class="far fa-edit"></i><?php the_modified_time("Y年m月d日");?></p>
                            </div>
                            <!-- 抜粋を表示 -->
                            <p class="post-content-detail"><?php the_excerpt(); ?></p>
                        </div>
                        <a href="<?php the_permalink(); ?>"></a>
                    </div>
                    <hr class="hr-narrow-dotted">
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <!-- ページネーション -->
            <?php get_template_part('content', 'pagination'); ?>

        </article>

        <!-- サイドバー -->
        <?php get_sidebar(); ?>

        </div>
    </div>
</section>

<!-- フッター -->
<?php get_footer(); ?>