<h6 class="filter-title"><?php echo $filter_title; ?></h6>
<ul class="selection">

<!--    <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Show All</p></label></li>-->

    <?php foreach (get_terms($filter) as $term) :  ?>
    <li><label>
            <?php
            $check = [];
            $current_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $parsed = parse_url($current_url);
            $query = $parsed['query'];
            parse_str($query, $params);
            $check = $params[$filter];
            if($check) {
                $remove_parames = $params;
                $key = array_search ($term->slug, $check);
                unset($remove_parames[$filter][$key]);
            }
            $remove_url_params = http_build_query($remove_parames);
            $path = '/funds/';
            $remove_url = $parsed['scheme'].'://'.$parsed['host'].$path;
            if($remove_url_params) {
                $remove_url = $parsed['scheme'].'://'.$parsed['host'].$path.'?'.$remove_url_params;
            }
            $params[$filter][] = $term->slug;
            $add_url_params = http_build_query($params);
            $add_url = $parsed['scheme'].'://'.$parsed['host'].$path;
            if($add_url_params) {
                $add_url = $parsed['scheme'].'://'.$parsed['host'].$path.'?'.$add_url_params;
            }

            ?>
            <?php if(is_array($_GET[$filter]) && in_array($term->slug,$_GET[$filter])) {; ?>
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