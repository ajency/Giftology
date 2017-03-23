<h6 class="filter-title"><?php echo $filter_title; ?></h6>
<ul class="selection">

<!--    <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Show All</p></label></li>-->

    <?php foreach (get_terms($filter) as $term) :  ?>
    <li><label>
            <?php if(in_array($term->slug,$_GET[$filter])) { ?>
            <a href="<?php echo esc_url( remove_query_arg( $filter.'[]') )?>" class="label-name">
                <input type="checkbox" class="checkbox-inline" checked>
                <?php print $term->name; ?>
            </a>

            <?php } else { ?>
                <a href="<?php echo esc_url( add_query_arg( $filter.'[]', $term->slug ) )?>" class="label-name">
                    <input type="checkbox" class="checkbox-inline">
                    <?php print $term->name; ?>
                </a>
            <?php } ?>
        </label></li>
    <?php endforeach;  ?>
    <?php if($show_all_link) :  ?>
    <li class="showAll"><a href="" class="show-all underline">Show all</a></li>
    <?php endif;  ?>
</ul>