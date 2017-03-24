<h6 class="filter-title"><?php echo $filter_title; ?></h6>
<ul class="selection">

<!--    <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Show All</p></label></li>-->

    <?php foreach (get_terms($filter) as $term) :  ?>
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
            <?php if(is_array($filter_params_input[$filter]) && in_array($term->slug,$filter_params_input[$filter])) {; ?>
            <a href="<?php echo $remove_url; ?>" class="label-name">
                <input disabled type="checkbox" class="checkbox-inline" checked>
                <?php print $term->name; ?>
            </a>

            <?php } else { ?>
                <a href="<?php echo $add_url; ?>" class="label-name">
                    <input disabled type="checkbox" class="checkbox-inline">
                    <?php print $term->name; ?>
                </a>
            <?php } ?>
        </label></li>
    <?php endforeach;  ?>
    <?php if($show_all_link) :  ?>
    <li class="showAll"><a href="" class="show-all underline">Show all</a></li>
    <?php endif;  ?>
</ul>