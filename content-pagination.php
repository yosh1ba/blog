<?php if(paginate_links()) : //ページネーションが1ページ以上あれば以下を表示 ?>
    <div class="pagination">
        <?php echo paginate_links(
            array(
                'end_size' => 0,
                'mid_size' => 1,
                'prev_next' => true,
                'prev_text' => '<i class="fas fa-angle-double-left"></i>',
                'next_text' => '<i class="fas fa-angle-double-right"></i>',
            )
        );
        ?>
    </div>
<?php endif ?>