<?php foreach($get_comment as $post){ ?>
<div class="comments-list">
	<div class="media">
		<p class="pull-right"><small><?php echo $gc->feedback_date ?></small></p>
		<a class="media-left" href="#">
		</a>
		<div class="media-body">
			<h4 class="media-heading user_name"><?php echo $gc->user?></h4><?php echo $gc->feedback?>
		</div>
	</div>
</div>
<?php } ?>