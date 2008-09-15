<?php
    if($tag->tag_posts){
        foreach($tag->tag_posts as $row){
            $post = new Post($row['post_id'], 'id');
        ?>
<?php $post->print_post(); ?>
<div class="footerspace">
</div>
<?php
        }
        ?>
        <div class="paging">
            <?php
                echo($tag->tag_paging);
            ?>
        </div>
<?php
  }else{
?>
<h1>
    <?php
        if($tag->tag_id == ''){
            echo 'No \'' . $_GET['tag'] .'\' tag created yet.';
        }else{
            echo 'No posts for \'' . $tag->tag_name .'\' tag.';
        }
    ?>
</h1>
<?php
}
?>