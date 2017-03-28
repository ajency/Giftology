<h6 class="filter-title"><?php echo $filter_title; ?></h6>
<ul class="selection">

<!--    <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Show All</p></label></li>-->

    <?php $terms = get_terms($filters[$filter]); foreach ($terms as $term) :  ?>
    <?php if($two_level == false || ($two_level == true && $term->parent != 0)) :  ?>
    <li><label>
            <?php
            $params1 = $filter_params;
            if($params1[$filter]) {
                $remove_params = $filter_params;
                $key = array_search ($term->slug, $filter_params[$filter]);
                unset($remove_params[$filter][$key]);
            }
            $remove_url = $parsed['scheme'].'://'.$parsed['host'].$path;
            if($remove_params) {
                $remove_url_params = http_build_query($remove_params);
                $remove_url = $parsed['scheme'].'://'.$parsed['host'].$path.'?'.$remove_url_params;
            }
            $params1[$filter][] = $term->slug;
            $add_url_params = http_build_query($params1);
            $add_url = $parsed['scheme'].'://'.$parsed['host'].$path;
            if($add_url_params) {
                $add_url = $parsed['scheme'].'://'.$parsed['host'].$path.'?'.$add_url_params;
            }

            ?>
            <?php

            if($two_level && $term->parent != 0) {
                $seperator = ' > ';
                    $parent_key = array_search($term->parent, array_map(function($o){ return $o->term_id; }, $terms));
                    $term_label = $terms[$parent_key]->name.$seperator.$term->name;
            } else {
                $term_label = $term->name;
            }

            ?>
            <?php if(is_array($filter_params_input[$filter]) && in_array($term->slug,$filter_params_input[$filter])) {; ?>

            <a href="<?php echo $remove_url; ?>" class="label-name">
                <i class="fa fa-check-circle checkbox-inline" aria-hidden="true"></i>
                <b>
                    <?php echo $term_label; ?>
                </b>
            </a>

            <?php } else { ?>
                <a href="<?php echo $add_url; ?>" class="label-name">
                    <i class="fa fa-circle-thin checkbox-inline" aria-hidden="true"></i>
                    <?php echo $term_label; ?>
                </a>
            <?php } ?>
        </label></li>
    <?php endif;  ?>
    <?php endforeach;  ?>
    <?php if($show_all_link) :  ?>
    <li class="showAll"><a href="" class="show-all underline">Show all</a></li>
    <?php endif;  ?>
</ul>