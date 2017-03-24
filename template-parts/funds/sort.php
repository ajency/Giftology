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
<li>
    <a id="sort-new" href="<?php echo sort_url('latest',$parsed,$params) ?>">Newest</a>
</li>
<li>
    <a id="sort-popular" href="<?php echo sort_url('popular',$parsed,$params) ?>">Popular</a>
</li>
<li>
    <a id="sort-rating" href="<?php echo sort_url('rating',$parsed,$params) ?>">Rating</a>
</li>
<li>
    <a id="sort-updated" href="<?php echo sort_url('last-updated',$parsed,$params) ?>">Last Updated</a>
</li>