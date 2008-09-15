<?php
    if($category->cat_posts){
		foreach($category->cat_posts as $row){
            $post = new Post($row['post_id'], 'id');
            $post->print_post(); ?>
<div class="footerspace">
</div>
<?php
        }
        ?>
        <div class="paging">
            <?php
                echo($category->cat_paging);
            ?>
        </div>
            
<?php
    }else{
?>
<h1>
    <?php
        if($category->cat_id == ''){
            echo 'No \'' . $_GET['category'] .'\' category created yet.';
        }else{
            echo 'No posts for \'' . $category->cat_name .'\' category.';
        }
    ?>
</h1>
<?php
    }
?>