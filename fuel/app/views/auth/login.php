<div class="login-form">
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

	<?php echo Form::open(array('action' => '', 'method' => 'post', 'id' => "form_login"));?>
		<?php echo $form?>
		<div class="form-group">
			<div class="controls">
				<?php echo Form::submit('submit', 'Вход', $attributes = array('class' => "btn"))?>
			</div>
		</div>
	
	<?php echo Form::close();?>
</div>