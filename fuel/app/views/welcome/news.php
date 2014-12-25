<div class="home-content side-content">
	<ul class="list-group">
		<?php foreach ($news as $item):?>
		<li href="#" class="list-group-item">
			<?php if (Asset::find_file($item->source, 'img','news/')):?>
			<?php echo Asset::img('news/'.$item->source, array('class' => 'pull-left', 'style' => 'margin-right: 15px;'))?>
			<?php endif;?>
			<h4 class="list-group-item-heading"><?php echo $item->title?></h4>
			<p class="list-group-item-text"><?php echo $item->description?></p>
			<div class="clear"></div>
		</li>
	  	<?php endforeach;?>
	</ul>
</div>