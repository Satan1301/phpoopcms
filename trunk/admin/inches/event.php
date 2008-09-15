<?php
    if(isset($_GET['task'])){
        if($_GET['task'] == 'edit'){
            $event = new Event($_GET['name']);
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<h2>Event edit form</h2>
<p>Please enter the appropriate details below</p>
<input type="hidden" value="<?php echo $event->event_id; ?>" name="hidEventID" />
<label>Event Name <span class="small">Enter event name</span> </label>
<input class="txt" type="text" name="txtEventName" id="name" value="<?php echo $event->event_name; ?>" />
<label>Event Date <span class="small">[Y-m-d H:i:s]</span> </label>
<input class="txt" type="text" name="txtEventDate" id="date" value="<?php echo $event->event_datetime; ?>" />
<label>Event Desc.<span class="small">Enter category description</span> </label>
<textarea name="txtEventDesc" cols="1" rows="1"><?php echo $event->event_desc; ?></textarea>
<input class="btn" type="submit" name="btnEventUpdate" value="Update" />
</form>
</div>
<?php
        }elseif($_GET['task'] == 'new'){
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<h2>Event edit form</h2>
<p>Please enter the appropriate details below</p>
<label>Event Name <span class="small">Enter event name</span> </label>
<input class="txt" type="text" name="txtEventName" id="name" value="" />
<label>Event Date <span class="small">[Y-m-d H:i:s]</span> </label>
<input class="txt" type="text" name="txtEventDate" id="date" value="" />
<label>Event Desc.<span class="small">Enter event description</span> </label>
<textarea name="txtEventDesc" cols="1" rows="1"></textarea>
<input class="btn" type="submit" name="btnEventAdd" value="Add" />
</form>
</div>
<?php
        }elseif($_GET['task'] == 'delete'){
            $event = new Event($_GET['name']);
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<input type="hidden" value="<?php echo $event->cat_id; ?>" name="hidEventID" />
                <h1>
                    <?php echo html_entity_decode($event->cat_name); ?>
                </h1>
                <p class="desc">
                    <?php echo html_entity_decode($event->cat_desc); ?>
                </p>
<input class="btn" type="submit" name="btnEventDelete" value="Delete" />
</form>
</div>
<?php
        }
    }else{
?>
<h1>
    <a href="<?php echo HTTP_SERVER.'index.php?event=1&task=new'; ?>">add new event</a>
</h1>
<h3>
</h3>
<p class="desc">
    Add a new category by clickin on above link.
</p>
<?php
        $events = getEvents();
        if(mysql_num_rows($events)){
            while($row = mysql_fetch_assoc($events)){
                $event = new Event($row['event_id']);
?>
                <h1>
                    <?php echo html_entity_decode($event->event_name); ?>
                </h1>
                <h3>
                <a href="<?php echo HTTP_SERVER.'index.php?event=1&name='.html_entity_decode($event->event_id).'&task=edit'; ?>">edit</a>
                <a href="<?php echo HTTP_SERVER.'index.php?event=1&name='.html_entity_decode($event->event_id).'&task=delete'; ?>" onclick="if(confirm('Are you sure want to delete?')){return true;}else{return false;}">delete</a>
                </h3>
                <p class="desc">
                    <?php echo 'Date: ' .$event->event_datetime . '<br />Description: ' .html_entity_decode($event->event_desc); ?>
                </p>
<?php
            }
        }else{
?>
            <h1>
<?php
            if($eventegory->cat_id == ''){
                echo 'No \'' . $_GET['category'] .'\' category created yet.';
            }else{
                echo 'No posts for \'' . $eventegory->cat_name .'\' category.';
            }
?>
            </h1>
<?php
        }
    }
?>