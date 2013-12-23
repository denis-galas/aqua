<div class="side-content">
	<h1>Скачать Прайс</h1>
	
	<ul class="list-group">
		<?php foreach ($prices as $price):?>
		<li href="#" class="list-group-item">
			<h4 class="list-group-item-heading"><a href="/assets/prices/<?php echo $price->source?>"><?php echo Asset::img('Excel-icon_25x25.png', array())?> <?php echo $price->title?></a></h4>
			<p class="list-group-item-text"><?php echo $price->description?></p>
		</li>
	  	<?php endforeach;?>
	</ul>
</div>