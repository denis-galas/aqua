<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Аквариумистика - <?php echo $title?></title>
	<?php echo Asset::css('bootstrap.min.css'); ?>
	<?php //echo Asset::css('bootstrap-theme.min.css'); ?>
	<?php echo Asset::css('styles.css'); ?>
	
	<?php echo Asset::js('jquery-1.10.2.min.js'); ?>
	<?php echo Asset::js('bootstrap.min.js'); ?>
	<?php echo Asset::js('jcarousellite_1.0.1.min.js'); ?>
</head>
<body>
<script type="text/javascript">
$(function(){
	$('.dropdown').mouseover(function(){
		$(this).addClass('open');
	});
	$('.dropdown').mouseout(function(){
		$(this).removeClass('open');
	});

	$('#carousel-slide').jCarouselLite({
	    auto: 2000,
	    speed: 2000,
	    vertical: true,
	});
});
</script>

	<div id="wrap">
		<div class="container">
			<div class="container-inner">
				<nav role="navigation" class="navbar navbar-inverse">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button data-target="#navbar" data-toggle="collapse" class="navbar-toggle" type="button">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="/" class="navbar-brand"><?php echo Asset::img('home-hover.png', array())?></a>
					</div>
		
					<?php $active_url = \Request::active()->route->translation;
					if ($active_url == 'welcome/gallery') {
						$active_url .= '/'.Request::active()->route->named_params['category'];
					}
					?>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div id="navbar" class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<li <?php if(stripos($active_url,'index') !== false) echo "class='active'"?>><a href="/">Главная</a></li>
							<li <?php if(stripos($active_url,'welcome/prices') !== false) echo "class='active'"?>><a href="/prices">Скачать прайс</a></li>
							
							<?php $categories = Model_Fcategory::returnArray();?>
							<li class="dropdown">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">Галлерея <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<?php foreach ($categories as $id => $category):?>
									<li <?php if(stripos($active_url,'welcome/gallery/'.$id) !== false) echo "class='active'"?>><a href="/gallery/<?php echo $id?>"><?php echo $category?></a></li>
									<?php endforeach;?>
								</ul>
							</li>
							
							<li <?php if(stripos($active_url,'contact') !== false) echo "class='active'"?>><a href="/contact">Сделать заказ</a></li>
							<li <?php if(stripos($active_url,'about') !== false) echo "class='active'"?>><a href="/about">О нас</a></li>
							<?php if (Auth::check()):?>
							<li class="dropdown">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">Администратор <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li class="dropdown-header">Управление:</li>
									<li <?php if(stripos($active_url,'admin/news') !== false) echo "class='active'"?>><a href="/admin/news">Новостями</a></li>
									<li <?php if(stripos($active_url,'admin/prices') !== false) echo "class='active'"?>><a href="/admin/prices">Прайсами</a></li>
									<li <?php if(stripos($active_url,'admin/slides') !== false) echo "class='active'"?>><a href="/admin/slides">Слайдшоу</a></li>
									<li <?php if(stripos($active_url,'admin/categories') !== false) echo "class='active'"?>><a href="/admin/categories">Категориями</a></li>
									<li <?php if(stripos($active_url,'admin/gallery') !== false) echo "class='active'"?>><a href="/admin/gallery">Галлереей</a></li>
									<li class="divider"></li>
									<li><a href="/admin/logout">Выход</a></li>
								</ul>
							</li>
							<?php endif;?>
						</ul>
					</div><!-- /.navbar-collapse -->
				</nav>

				<div class="raw content">
					<?php
						$slides = Model_Slide::find('all');
						if (count($slides) > 0 && stripos($active_url,'admin') === false && stripos($active_url,'welcome/gallery') === false):
					?>
					<div id="carousel-slide-wrapper">
						<h4>Новинки</h4>
						<div id="carousel-slide">
							<ul>
								<?php foreach ($slides as $slide):?>
								<li class="item">
									<div class="item-inner">
										<?php echo Asset::img('slides/'.$slide->source, array())?>
										<div class="slide-caption">
											<h5><?php echo $slide->title?></h5>
											<p><?php echo $slide->description?></p>
										</div>
									</div>
								</li>
								<?php endforeach;?>
							</ul>
						</div>
					</div>
					<?php endif;?>
					<?php echo $content; ?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
		
	<div id="footer">
		<hr/>
		<div class="container">
			<div class="foot-inside">
				<div class="pull-right">Copyright (c) 2013</div>
				<address>
					Тел. (123) 456-7890<br>
					Тел. (123) 456-7890
				</address>
			</div>
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
							<label for="inputPassword3" class="col-sm-2 control-label">Файл</label>
							<div class="col-sm-10">
								<input type="file"/>
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
