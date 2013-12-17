<?php echo Asset::css('lightbox.css'); ?>
<?php echo Asset::js('lightbox.js'); ?>

<div id="gallery">
	<?php for ($i = 0; $i < 10; $i++):?>
	<?php foreach ($photos as $photo):?>
	<div class="gallery-item">
		<a title="<?php echo $photo->title?>" href="/assets/img/gallery/<?php echo $photo->source?>">
			<?php echo Asset::img('gallery/thumbs/'.$photo->source, array())?>
			<h5 style="text-align: center;"><?php echo $photo->title?></h5>
		</a>
	</div>
	<?php endforeach;?>
	<?php endfor;?>
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