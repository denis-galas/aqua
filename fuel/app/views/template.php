<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Аквариумистика - <?php echo $title?></title>
	<?php echo Asset::css('bootstrap.min.css'); ?>
	<?php echo Asset::css('bootstrap-theme.min.css'); ?>
	<?php echo Asset::css('styles.css'); ?>
	<?php echo Asset::js('jquery-1.10.2.min.js'); ?>
	<?php echo Asset::js('bootstrap.min.js'); ?>
</head>
<body>
	<div class="container">
		<nav role="navigation" class="navbar navbar-inverse">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button data-target="#bs-example-navbar-collapse-9" data-toggle="collapse" class="navbar-toggle" type="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="/" class="navbar-brand">Brand</a>
			</div>

			<?php $active_url = \Request::active()->route->translation;?>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div id="bs-example-navbar-collapse-9" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li <?php if(stripos($active_url,'index') !== false) echo "class='active'"?>><a href="/">Главная</a></li>
					<li <?php if(stripos($active_url,'prices') !== false) echo "class='active'"?>><a href="/prices">Прайсы</a></li>
					<li <?php if(stripos($active_url,'contacts') !== false) echo "class='active'"?>><a href="/contacts">Контакты</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>
		
		<div class="raw content">
			<?php echo $content; ?>
		</div>
		
		<div class="footer">
			<div class="pull-right">Copyright (c) 2013</div>
			<address>
				Тел. (123) 456-7890<br>
				Тел. (123) 456-7890
			</address>
		</div>
	</div>
	
	<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="contactModalLabel">Написать нам</h4>
				</div>
				<div class="modal-body">
					<form accept-charset="utf-8" class="form-horizontal" id="form_contact" method="post" action="#">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Тема</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="inputEmail3">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Сообщение</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="5"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label"></label>
							<div class="col-sm-10">
								<input type="submit" id="form_submit" value="Отправить" name="submit" class="btn btn-primary">
								<button name="cancel" data-dismiss="modal" class="btn">Закрыть</button>
							</div>
						</div>
					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
</body>
</html>
