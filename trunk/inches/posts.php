<?php if($posts->post_posts){
		foreach($posts->post_posts as $row){
//        while($row = mysql_fetch_assoc($posts->post_posts)){
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