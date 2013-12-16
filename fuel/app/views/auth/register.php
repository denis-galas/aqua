<div class="header">
	<h2>Registration of new Hbadmin</h2>
</div>
<div class="step-inside">
	<?php if ($form->show_errors()):?>
		<div class="alert alert-error">
			<?php echo $form->show_errors();?> 
		</div>
	<?php endif;?>

	<?php echo Form::open(array('action' => '', 'method' => 'post', 'id' => "form_registration", "class" => "form-horizontal"));?>
		<?php echo $form?>
		<div class="control-group">
			<div class="controls">
				<?php echo Form::submit('submit', 'Register', $attributes = array('class' => "btn btn-primary"))?>
			</div>
		</div>
		</div>
	
	<?php echo Form::close();?>
</div>

<script type="text/javascript">
$(function(){
	$('#form_registration').submit(function() {
		var el = $('#form_email');
		var email = el.val();
		var error = emailValidation(email)
		if (error) {
			el.closest('.control-group').addClass('error');
			el.closest('.control-group').find('.help-inline').text(error);
			return false;
		}
	});

	/**
	 * Function validates emails and returns error
	 */
	function emailValidation(email) {
		var valid = true;
	    var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var error = '';
		
		if (!email.trim()) {
			error = "Email should be not empty";
		} else if(email.trim() && !pattern.test(email.trim())){
			error = "Wrong email format";
		} else {
			$.ajax({
				type : "POST",
				url : '/hbadmin/validateEmail',
				data : {
					'email' : email
				},
				async : false,
				success : function(response) {
					error = response;
				}
			});
		}
		return error;
	}
});
</script>
