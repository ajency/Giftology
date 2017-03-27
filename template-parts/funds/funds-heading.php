<div class="row m-t-1">
    <div class="col-sm-9">
        <div class="fund-list">
            <h1 class="fund-list__heading"><?php echo isset(get_queried_object()->label) ? get_queried_object()->label : get_queried_object()->name; ?> <div class="search">
                    <input type="search" class="input-search" value="<?php echo $_GET['search']; ?>"><span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span></div></h1>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="popular">
            <p class="sort">Sort by : </p>
            <?php
            $buckets = (get_option('_amfg_bucket_settings'));
            $sort_by = [
                'popular' => 'Featured',
                'latest' => 'Newest',
                'oldest' => 'Oldest',
                'rating-up' => 'Highest Crisil Rank',
                'rating-down' => 'Lowest Crisil Rank',
                'highest-returns' => 'Highest Returns',
                'lowest-returns' => 'Lowest Returns',
                'last-updated' => 'Last Updated',

            ];
            ?>
            <div class="dropdown">
                <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo isset($_GET['sort']) ? ucfirst(esc_html($sort_by[$_GET['sort']])) : $sort_by['latest']; ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dLabel">
                    <?php
                    $current_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                    $parsed = parse_url($current_url);
                    $query = $parsed['query'];
                    parse_str($query, $params);
                    function sort_url ($current_sort_option,$parsed,$params) {
                        $check = $params['sort'];
                        if($check) {
                            unset($params['sort']);
                        }
                        $params['sort'] = $current_sort_option;
                        $sort_params = http_build_query($params);
                        return $parsed['scheme'].'://'.$parsed['host'].$parsed['path'].'?'.$sort_params;
                    }
                    ?>
                    <?php foreach ($sort_by as $key=> $value) : ?>
                        <li>
                            <a id="sort-<?php echo $key ?>" href="<?php echo sort_url($key,$parsed,$params) ?>"><?php echo $value; ?></a>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </div>
        </div>
    </div>
</div>

<div class="filter-trigger">
    <i class="fa fa-filter" aria-hidden="true"></i>
</div>

