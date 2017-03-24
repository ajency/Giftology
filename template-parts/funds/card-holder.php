<div class="card-holder">
    <?php
    $filters = ['amc','bucket-1','bucket-2','bucket-3'];

    foreach($filters as $filter) {
        if(isset($content_params_input[$filter]) && !empty($content_params_input[$filter]))
        {
            //TODO - can also check if the term exists for the respective category
            $q[] = [ 'taxonomy' => $filter, 'field' => 'slug', 'terms' => $content_params_input[$filter] ];
        }
    }

    $tax_query = array(
        'relation' => 'AND',
        $q
    );

    $query = array(
        'post_type' => 'fund',
        'paged' => $paged ,
        'status' => 'publish',
        'tax_query' => $tax_query
    );

    if($content_params_input['search']) {
        $query['s'] = $content_params_input['search'];
    }

    if($content_params_input['sort'] == 'latest') {

        $query['orderby'] = 'created';
        $query['order'] = 'DESC';

    } else if ($content_params_input['sort'] == 'rating'){

        $query['meta_key'] = '_fund_crisil_rating';
        $query['orderby'] = 'meta_value_num';
        $query['order'] = 'DESC';

    } else if ($content_params_input['sort'] == 'popular'){

        $query['meta_key'] = '_fund_featured';
        $query['orderby'] = 'meta_value_num';
        $query['order'] = 'DESC';

    } else if ($content_params_input['sort'] == 'last-updated'){

        $query['orderby'] = 'updated';
        $query['order'] = 'DESC';
    }

    $loop = new WP_Query( $query );

    ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post(); // standard WordPress loop. ?>
        <?php get_template_part( 'template-parts/funds/fund', 'card' ); ?>
        <!-- 2nd -->

    <?php endwhile; // end of the loop. ?>

</div>
<?php giftology_numeric_posts_nav($loop) ?>