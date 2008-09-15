<h1>Feedback:</h1>
<h3>posted by <a href="<?php echo HTTP_SERVER ?>about-me.html"><?php echo AUTHOR; ?></a></h3>
<p class="desc">Please leave your feedback about the website, the bugs
you found, the things you like or things you want to see improved or the
content you want me to add in the future.</p>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action=""
	onsubmit="return validateFeedback();">
<h2>Feedback form</h2>
<p>Please post your feedbacks about the website</p>
<label>Name <span class="small" id="commentName">(Required)</span> </label>
<input class="txt" type="text" name="txtName" id="name" /> <label>Email
<span class="small" id="commentEmail">(Required)</span> </label> <input
	class="txt" type="text" name="txtEmail" id="email" /> <label>Webpage <span
	class="small">(Optional)</span> </label> <input class="txt" type="text"
	name="txtWebPage" id="webpage" /> <label>Comments <span class="small"
	id="commentText">(Required)</span> </label> <textarea
	name="txtComments" cols="1" rows="1" id="comment"></textarea> <input
	class="btn" type="submit" name="btnPostFeedback" value="Post Feedback" />
</form>
</div>
<div id="comments">
<?php
	echo getFeedbacks();
?>
</div>

<div class="postfoot">
<p><a href="http://delicious.com/post"
	onclick="window.open('http://delicious.com/post?v=5&amp;noui&amp;jump=close&amp;url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title), 'delicious','toolbar=no,width=550,height=550'); return false;">
Bookmark this on Delicious</a></p>
</div>
