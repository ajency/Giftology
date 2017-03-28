<?php
if( !defined( 'ABSPATH' ) ) exit;
?>

<div class="card-holder">

    <?php

    foreach($filters as $key => $filter) {
        if(isset($content_params_input[$key]) && !empty($content_params_input[$key]))
        {
            //TODO - can also check if the term exists for the respective category
            $q[] = [ 'taxonomy' => $filter, 'field' => 'slug', 'terms' => $content_params_input[$key] ];
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

    } else if($content_params_input['sort'] == 'oldest') {

        $query['orderby'] = 'created';
        $query['order'] = 'ASC';

    } else if ($content_params_input['sort'] == 'rating-up'){

        $query['meta_key'] = '_fund_crisil_rating';
        $query['orderby'] = 'meta_value_num';
        $query['order'] = 'DESC';

    } else if ($content_params_input['sort'] == 'rating-down'){

        $query['meta_key'] = '_fund_crisil_rating';
        $query['orderby'] = 'meta_value_num';
        $query['order'] = 'ASC';

    } else if ($content_params_input['sort'] == 'highest-returns'){

        $query['meta_key'] = '_fund_returns';
        $query['orderby'] = 'meta_value_num';
        $query['order'] = 'DESC';

    } else if ($content_params_input['sort'] == 'lowest-returns'){

        $query['meta_key'] = '_fund_returns';
        $query['orderby'] = 'meta_value_num';
        $query['order'] = 'ASC';

    } else if ($content_params_input['sort'] == 'popular'){

        $query['meta_key'] = '_fund_featured';
        $query['orderby'] = 'meta_value_num';
        $query['order'] = 'DESC';

    } else if ($content_params_input['sort'] == 'last-updated'){

        $query['orderby'] = 'modified';
        $query['order'] = 'DESC';
    }



    $loop = new WP_Query( $query );

    if ($loop->have_posts() ) :
        while ( $loop->have_posts() ) : $loop->the_post(); // standard WordPress loop. ?>

            <?php        include locate_template('template-parts/funds/fund-card.php', false, false); ?>
            <!-- 2nd -->

        <?php endwhile;
    else :
        ?>

        <h1 class="no-data">No results found. Try being a little less specific.</h1>
    <?php endif; ?>
</div>
<?php giftology_numeric_posts_nav($loop) ?>