<?php 

    $bt = BlockType::getByHandle('blog_posts');
    $bt->controller->num_posts_to_show = 8;
    $bt->controller->paginate = true;
    $bt->controller->characters_to_display = 250;
    $bt->controller->max_thumb_width = 125;
    $bt->controller->show_thumbs = true;
    $bt->controller->order_by = 'date_desc';
    $bt->controller->show_posts_from = 0;
    $bt->render('view');

?>