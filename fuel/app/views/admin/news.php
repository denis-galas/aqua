<?php echo Asset::js('tinymce/tinymce.min.js'); ?>

<div>
	<h3>Управление новостями</h3>
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
	<?php foreach ($news as $item):?>
	<li href="#" class="list-group-item">
		<a href="/admin/newsDelete?id=<?php echo $item->id?>" class="pull-right delete"><span class="glyphicon glyphicon-remove"></span></a>
		<a href="/admin/news?id=<?php echo $item->id?>&edit=1" class="pull-right" style="margin-right: 10px;"><span class="glyphicon glyphicon-edit"></span></a>
		<?php if (Asset::find_file($item->source, 'img','news/')):?>
		<?php echo Asset::img('news/'.$item->source, array('class' => 'pull-left', 'style' => 'margin-right: 15px;'))?>
		<?php endif;?>
		<h4 class="list-group-item-heading"><?php echo $item->title?></h4>
		<p class="list-group-item-text"><?php echo $item->description?></p>
		<div class="clear"></div>
	</li>
  	<?php endforeach;?>
</ul>

<script>
$(function(){
	tinymce.init({
		plugins: "link, searchreplace, table",
	    selector: "#form_description",
	    language : 'ru',
	    menu: { 
	        file: {title: 'File', items: 'newdocument'}, 
	        edit: {title: 'Edit', items: 'undo redo | cut copy paste | selectall'}, 
	        format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'}, 
	    },
	    statusbar : false,
	    toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright | link table | searchreplace",
	 });
		
	
	$('#slides_form').submit(function(){
		if ($('#form_source_file').val())
			$('#form_source').val($('#form_source_file').val());
	});

	$('.delete').click(function(){
		var conf = confirm('Вы уверены, что хотите удалить новость?');
		if (!conf) {
			return false;
		}
	});
});
</script>