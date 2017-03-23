<h6 class="filter-title"><?php echo $filter_title; ?></h6>
<ul class="selection">
    <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Show All</p></label></li>
    <?php foreach ($terms as $term) :  ?>
    <li><label>
            <input type="checkbox" class="checkbox-inline">
            <a href="<?php echo esc_url( add_query_arg( 'amc[]', $term->slug ) )?>" class="label-name"><?php print $term->name; ?></a>
        </label></li>
    <?php endforeach;  ?>
    <?php if($show_all_link) :  ?>
    <li class="showAll"><a href="" class="show-all underline">Show all</a></li>
    <?php endif;  ?>
</ul>