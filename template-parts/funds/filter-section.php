<div class="filter-bar">
    <div class="card header">
        <p class="filter-name"><i class="fa fa-filter" aria-hidden="true"></i> <b>Filters</b></p>
        <a href="<?php echo $path; ?>" class="reset underline">Reset</a>
    </div>
    <div class="card body">
        <?php
        $show_all_link = false;
        $filter_title = 'Filter by AMC';
        $filter = 'amc';
        $filter_params = $filter_params_input;
        include locate_template('template-parts/funds/filters.php', false, false);
        ?>
    </div>
    <div class="card body">
        <?php
        $show_all_link = false;
        $filter_title = 'Filter by Bucket 1';
        $filter = 'bucket-1';
        $filter_params = $filter_params_input;
        include locate_template('template-parts/funds/filters.php', false, false);
        ?>
    </div>
    <div class="card body">
        <?php
        $show_all_link = false;
        $filter_title = 'Filter by Bucket 2';
        $filter = 'bucket-2';
        $filter_params = $filter_params_input;
        include locate_template('template-parts/funds/filters.php', false, false);
        ?>
    </div>
    <div class="card body">
        <?php
        $show_all_link = false;
        $filter_title = 'Filter by Bucket 3';
        $filter = 'bucket-3';
        $filter_params = $filter_params_input;
        include locate_template('template-parts/funds/filters.php', false, false);
        ?>
    </div>
</div>