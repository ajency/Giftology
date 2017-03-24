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
            <div class="dropdown">
                <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo isset($_GET['sort']) ? ucfirst(esc_html($_GET['sort'])) : 'Popular'; ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dLabel">
                    <?php include locate_template('template-parts/funds/sort.php', false, false); ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="filter-trigger">
    <i class="fa fa-filter" aria-hidden="true"></i>
</div>

