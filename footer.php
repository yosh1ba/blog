            <footer>
                <div class="wrapper">
                    <span class="footer-logo">&copy; 2019 yoshiba</span>
                </div>
                <nav id="footer-nav">
                    <!-- <ul class="footer-list d-flex">
                        <li class="footer-menu-item d-flex"><i class="fas fa-home"></i><a href="" class="footer-menu-anchor">ホーム</a></li>
                        <li class="footer-menu-item d-flex"><i class="fas fa-laptop-code"></i><a href="" class="footer-menu-anchor">技術</a></li>
                        <li class="footer-menu-item d-flex"><i class="fas fa-book"></i><a href="" class="footer-menu-anchor">雑記</a></li>
                        <li class="footer-menu-item d-flex"><i class="fas fa-star"></i><a href="" class="footer-menu-anchor">ポートフォリオ</a></li>
                    </ul> -->
                    <?php
                    wp_nav_menu(
                        array(
                            'depth' => 1,   // 何階層まで表示させるか
                            'theme_location' => 'place_footer', // functions.phpで指定した値
                            'container' => 'false', // ulタグをdivで囲むかどうか
                            'menu_class' => 'footer-list',  // ulタグのクラスを指定
                        )
                    );
                    ?>
                </nav>
            </footer>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>