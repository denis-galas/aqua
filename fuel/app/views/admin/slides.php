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
	<?php echo Form::open(array('action' => $_SERVER['PHP_SELF'].$query, 'method' => 'post', 'enctype' => "multipart/form-data", 'id' => "slides_form"));?>
		<?php echo $form?>
		<div class="form-group">
			<div class="controls">
				<?php echo Form::submit('submit', 'Сохранить', $attributes = array('class' => "btn btn-primary"))?>
			</div>
		</div>
	
	<?php echo Form::close();?>
</div>

<ul class="list-group">
	<?php foreach ($slides as $slide):?>
	<li href="#" class="list-group-item">
		<a href="/admin/slideDelete?id=<?php echo $slide->id?>" class="pull-right delete"><span class="glyphicon glyphicon-remove"></span></a>
		<a href="/admin/slides?id=<?php echo $slide->id?>&edit=1" class="pull-right" style="margin-right: 10px;"><span class="glyphicon glyphicon-edit"></span></a>
		<h4 class="list-group-item-heading"><?php echo $slide->title?></h4>
		<p class="list-group-item-text"><?php echo Asset::img('slides/thumbs/'.$slide->source, array('class' => 'mini-slide pull-left', 'style' => 'margin-right: 15px;'))?> <?php echo $slide->description?></p>
		<div class="clear"></div>
	</li>
  	<?php endforeach;?>
</ul>

<script>
$(function(){
	$('#slides_form').submit(function(){
		if ($('#form_source_file').val())
			$('#form_source').val($('#form_source_file').val());
	});

	$('.delete').click(function(){
		var conf = confirm('Вы уверены, что хотите удалить слайд?');
		if (!conf) {
			return false;
		}
	});
});
</script>