<div class="filter-bar">
    <div class="card header">
        <p class="filter-name"><i class="fa fa-filter" aria-hidden="true"></i> <b>Filters</b></p>
        <a href="<?php echo $path; ?>" class="reset underline">Reset</a>
    </div>
    <div class="card body">
        <?php
        $filters = ['a' => 'amc','b1' => 'bucket-1','b2' => 'bucket-2','b3' => 'bucket-3'];
        $show_all_link = false;
        $filter_title = 'Filter by AMC';
        $two_level = false;
        $filter = 'a';
        $filter_params = $filter_params_input;
        include locate_template('template-parts/funds/filters.php', false, false);
        ?>
    </div>
    <div class="card body">
        <?php
        $show_all_link = false;
        $filter_title = 'Filter by '.$buckets['_amfg_bucket_1_singular'];
        $filter = 'b1';
        $two_level = false;
        $filter_params = $filter_params_input;
        include locate_template('template-parts/funds/filters.php', false, false);
        ?>
    </div>
    <div class="card body">
        <?php
        $show_all_link = false;
        $filter_title = 'Filter by '.$buckets['_amfg_bucket_2_singular'];
        $filter = 'b2';
        $two_level = true;
        $filter_params = $filter_params_input;
        include locate_template('template-parts/funds/filters.php', false, false);
        ?>
    </div>
    <div class="card body">
        <?php
        $show_all_link = false;
        $two_level = false;
        $filter_title = 'Filter by '.$buckets['_amfg_bucket_3_singular'];
        $filter = 'b3';
        $filter_params = $filter_params_input;
        include locate_template('template-parts/funds/filters.php', false, false);
        ?>
    </div>
</div>