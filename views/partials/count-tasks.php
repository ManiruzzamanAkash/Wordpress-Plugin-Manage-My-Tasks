<?php
$count_total_tasks = AMEAT_countTaskLists();
$pending_count = AMEAT_countTaskLists('Pending');
$done_count = AMEAT_countTaskLists('Done');
$search_value = isset($_POST['s']) ? sanitize_text_field( wp_unslash( $_POST['s'] ) ) : '';
?>

<div>
    <ul class="subsubsub">
        <li class="all"><a href="admin.php?page=tasks-all" class="current" aria-current="page">All <span class="count">(<?php echo esc_html( $count_total_tasks ); ?>)</span></a> |</li>
        <li class="publish"><a href="admin.php?page=tasks">Pending <span class="count">(<?php echo esc_html( $pending_count ); ?>)</span></a></li>
        <li class="publish"><a href="admin.php?page=tasks-complete">Done <span class="count">(<?php echo esc_html( $done_count ); ?>)</span></a></li>
    </ul>
</div>

<form action="" method="POST">
    <p class="search-box">
        <input type="search" id="post-search-input" name="s" value="<?php echo esc_html( $search_value ); ?>">
        <input type="submit" id="search-submit" name="search" class="button" value="Search Tasks">
    </p>
</form>