<!-- ヘッダー -->
<?php get_header(); ?>

<!-- メニュー -->
<?php get_template_part('content', 'menu'); ?>

<!-- メインコンテンツ -->
<section id="main">
    <div class="wrapper">
        <article class="entry-404">
            <h1 class="entry-404-header">404 Not Found</h1>
            <p class="entry-404-lead">お探しのページが見つかりませんでした</p>
            <p class="entry-404-content">
            申し訳ありませんが、お探しのページが存在しないか、アクセスできません。<br>
            入力されたURLが正しいかご確認ください。
            </p>
            <div class="entry-404-btn">
                <a href="<?php echo home_url(); ?>" class="btn">トップページに戻る</a>
            </div>
        </article>
    </div>
</section>

<!-- フッター -->
<?php get_footer(); ?>