<header>
    <div class="wrapper d-flex">
        <a href="<?php echo esc_url(home_url('/')); ?>" id="header-logo">
            <h1><span class="normal">YOSHIBA's </span>BOX</h1>
        </a>
        <nav id="header-nav">
            <?php
            wp_nav_menu(
                array(
                    'depth' => 1,   // 何階層まで表示させるか
                    'theme_location' => 'place_global', // functions.phpで指定した値
                    'container' => 'false', // ulタグをdivで囲むかどうか
                    'menu_class' => 'header-list',  // ulタグのクラスを指定
                )
            );
            ?>
        </nav>
    </div>
</header>   