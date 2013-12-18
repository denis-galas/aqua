<?php echo Asset::css('lightbox.css'); ?>
<?php echo Asset::js('lightbox.js'); ?>

<?php if (count($photos) == 0):?>
<h4 style="text-align: center;">В этой категории еще нет фотографий</h4>
<?php else:?>
<h4 style="text-align: center;"><?php echo $category->title?></h4>
<p style="text-align: center;"><?php echo $category->description?></p>
<?php endif;?>

<div id="gallery">
	<?php foreach ($photos as $photo):?>
	<div class="gallery-item">
		<a title="<?php echo $photo->title?>" href="/assets/img/gallery/<?php echo $photo->source?>">
			<?php echo Asset::img('gallery/thumbs/'.$photo->source, array())?>
			<h5 style="text-align: center;"><?php echo $photo->title?></h5>
		</a>
	</div>
	<?php endforeach;?>
	<div class="clear"></div>
</div>

<div class="clear"></div>
<script>
$(function() {
	$('#gallery a').lightBox({
		imageLoading: '/assets/img/lightbox/lightbox-ico-loading.gif',
		imageBtnClose: '/assets/img/lightbox/lightbox-btn-close.gif',
		imageBtnPrev: '/assets/img/lightbox/lightbox-btn-prev.gif',
		imageBtnNext: '/assets/img/lightbox/lightbox-btn-next.gif',
		fixedNavigation:true,
	});
});
</script>