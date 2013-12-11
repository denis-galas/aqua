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
				<abbr title="Телефон">Т:</abbr> (123) 456-7890<br>
				<abbr title="Телефон">Т:</abbr> (123) 456-7890
			</address>
		</div>
	</div>
</body>
</html>
