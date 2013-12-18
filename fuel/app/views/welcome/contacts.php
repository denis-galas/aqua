<h1>Контакты</h1>

<address>
	<strong>Twitter, Inc.</strong><br>
	795 Folsom Ave, Suite 600<br>
	San Francisco, CA 94107<br>
	<abbr title="Phone">P:</abbr> (123) 456-7890
</address>

<address>
	<a href="#" id="contactUs"><strong>Написать нам</strong></a>
</address>

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

<script type="text/javascript">
$(function(){
	$('#contactUs').click(function(){
		$('#contact-wrapper').toggle(1000);
		return false;
	});

	<?php if ($form->show_errors()):?>
	$('#contact-wrapper').show();
	<?php endif;?>
});
</script>
