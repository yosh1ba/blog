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
                    <article class="entry-page">
                        <h1 class="entry-header-1"><?php the_title(); ?></h1>
                        <div class="entry-img-area">
                        <?php
                            if (has_post_thumbnail() ) {
                                // アイキャッチ画像が設定されてれば大サイズで表示
                                the_post_thumbnail('large', array('class' => 'entry-thumbnail'));
                                } else {
                                // なければnoimage画像をデフォルトで表示
                                echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/thumbnail.jpg" alt="" class="entry-thumbnail" width="560">';
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
                    </article>
        </div>
    </div>
</section>

<!-- フッター -->
<?php get_footer(); ?>