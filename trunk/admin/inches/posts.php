<?php
    if($posts->post_posts){
        while($row = mysql_fetch_assoc($posts->post_posts)){
            $post = new Post($row['post_id'], 'id');
        ?>
<h1><a href="<?php echo HTTP_SERVER.$post->post_link; ?>.html"><?php echo html_entity_decode($post->post_h1); ?></a></h1>
<h3>posted by <a href="#">anonynous anon</a> under <?php echo getCatList($post->cats); ?> on 13th August 2006</h3>
<p class="desc"><?php echo html_entity_decode($post->post_h2); ?></p>
<?php echo $post->post_ps; ?>
<div class="postfoot">
    <p> Tagged under: <?php echo getTagList($post->tags); ?> </p>
</div>
<div class="postfoot">
    <p> <?php echo $post->comments; ?> Comments </p>
</div>
<div class="footerspace">
</div>
<?php
        }
        ?>
        <div class="paging">
            <?php
                echo($posts->post_paging);
            ?>
        </div>
            
<?php
    }else{
?>
<h1>
    Not a single post yet
</h1>
<?php
    }
?>