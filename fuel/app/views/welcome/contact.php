<div class="side-content">
	<h1>Сделать заказ</h1>
	
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
	<div id="contact-wrapper">
		<?php if ($form->show_errors()):?>
			<div class="alert alert-danger">
				<?php echo $form->show_errors();?> 
			</div>
		<?php endif;?>
	
		<?php echo Form::open(array('action' => '', 'method' => 'post', 'enctype' => "multipart/form-data", 'id' => "contact_form"));?>
			<?php echo $form?>
			<div class="form-group">
				<div class="controls">
					<?php echo Form::submit('submit', 'Отправить', $attributes = array('class' => "btn btn-primary"))?>
				</div>
			</div>
		
		<?php echo Form::close();?>
	</div>
</div>