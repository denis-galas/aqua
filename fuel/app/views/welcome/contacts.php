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

<div id="contactModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button class="close" aria-hidden="true" data-dismiss="modal" type="button">x</button>
		<h3>Написать нам</h3>
	</div>
	<div class="modal-body">asdasdasdasd</div>
</div>

<script type="text/javascript">
$(function(){
	$('#contactUs').click(function(){
		$('#contactModal').modal('show');
	    
		//need for not jump up page
		return false;
	});
});
</script>
