<div>
	<?php if ($message = Session::get_flash('success')):?>
		<div class="alert alert-success">
			<?php echo $message;?> 
		</div>
	<?php endif;?>

	<?php if ($message = Session::get_flash('error')):?>
		<div class="alert alert-danger">
			<?php echo $message;?> 
		</div>
	<?php endif;?>
	
	<?php if ($form->show_errors()):?>
		<div class="alert alert-danger">
			<?php echo $form->show_errors();?> 
		</div>
	<?php endif;?>

	<?php $query = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : ''?>
	<?php echo Form::open(array('action' => $_SERVER['PHP_SELF'].$query, 'method' => 'post', 'enctype' => "multipart/form-data", 'id' => "gallery_form"));?>
		<?php echo $form?>
		<div class="form-group">
			<div class="controls">
				<?php echo Form::submit('submit', 'Сохранить', $attributes = array('class' => "btn btn-primary"))?>
			</div>
		</div>
	
	<?php echo Form::close();?>
</div>

<?php echo Form::open(array('action' => '', 'method' => 'get', 'id' => "gallery_sort_form", 'style' => 'width: 200px;'));?>
<?php echo Form::select('category_sort', Session::get('category_sort'), Model_Fcategory::returnArray(true), array('class' => 'form-control', 'style'=>'margin-top: 30px; margin-bottom: 10px;'))?>
<?php echo Form::close();?>

<div id="gallery">
	<?php if (count($photos) == 0):?>
		<h4 class="list-group-item-heading">В этой категории еще нет фотографий</h4>
	<?php endif;?>
	<?php foreach ($photos as $photo):?>
	<div class="gallery-item">
		<a href="/admin/photoDelete?id=<?php echo $photo->id?>" class="pull-right delete"><span class="glyphicon glyphicon-remove"></span></a>
		<a href="/admin/gallery?id=<?php echo $photo->id?>&edit=1" class="pull-right" style="margin-right: 10px;"><span class="glyphicon glyphicon-edit"></span></a>
		<h4 class="list-group-item-heading"><?php echo $photo->title?> (<?php echo $photo->fcategory->title?>)</h4>
		<p class="list-group-item-text"><?php echo Asset::img('gallery/thumbs/'.$photo->source, array())?></p>
		<div class="clear"></div>
	</div>
	<?php endforeach;?>
	<div class="clear"></div>
</div>

<script>
$(function(){
	$('#gallery_form').submit(function(){
		if ($('#form_source_file').val())
			$('#form_source').val($('#form_source_file').val());
	});

	$('.delete').click(function(){
		var conf = confirm('Вы уверены, что хотите удалить фото?');
		if (!conf) {
			return false;
		}
	});

	$('#form_category_sort').change(function(){
		$('#gallery_sort_form').submit();
	});
});
</script>