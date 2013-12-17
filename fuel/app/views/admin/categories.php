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
	<?php echo Form::open(array('action' => $_SERVER['PHP_SELF'].$query, 'method' => 'post'));?>
		<?php echo $form?>
		<div class="form-group">
			<div class="controls">
				<?php echo Form::submit('submit', 'Сохранить', $attributes = array('class' => "btn"))?>
			</div>
		</div>
	
	<?php echo Form::close();?>
</div>

<ul class="list-group">
	<?php foreach ($categories as $category):?>
	<li href="#" class="list-group-item">
		<a href="/admin/categoryDelete?id=<?php echo $category->id?>" class="pull-right delete"><span class="glyphicon glyphicon-remove"></span></a>
		<a href="/admin/categories?id=<?php echo $category->id?>&edit=1" class="pull-right" style="margin-right: 10px;"><span class="glyphicon glyphicon-edit"></span></a>
		<h4 class="list-group-item-heading"><?php echo $category->title?></h4>
		<p class="list-group-item-text"><?php echo $category->description?></p>
	</li>
  	<?php endforeach;?>
</ul>

<script>
$(function(){
	$('.delete').click(function(){
		var conf = confirm('Вы уверены, что хотите удалить категорию?\nУдаление категории приведет к удалению всех фотографий из галлереи, прикрепленных к данной категории.');
		if (!conf) {
			return false;
		}
	});
});
</script>