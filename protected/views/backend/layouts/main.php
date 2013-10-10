<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php echo $this->pageTitle; ?> - Панель управления</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Main Style -->
    <link rel="stylesheet" href="/resources/backend/css/main.css">
	
    <!--[if lt IE 9]>
    <script src="/resources/backend/js/html5.js"></script>
    <![endif]-->

    <!-- Favicons -->
    <link rel="shortcut icon" href="favicon.ico">

    <?php Yii::app()->bootstrap->register(); ?>
</head>
<body>
<?php
	$this->widget('bootstrap.widgets.TbNavbar', array(
		'type'=>'inverse', // null or 'inverse'
		'brand'=>'Панель управления',
		'brandUrl'=>array('/backend'),
		'fluid' => true,
		'collapse'=>true, // requires bootstrap-responsive.css
		'items'=>array(
			array(
				'class'=>'bootstrap.widgets.TbMenu',
				'items'=>array(
                    array('label'=>'Данные', 'url'=>'#', 'items'=>array(
                        array('label'=>'Товары', 'icon'=>'list', 'url'=>array('/backend/products/index')),
                        array('label'=>'Ресурсы', 'icon'=>'list', 'url'=>array('/backend/uploads/index')),
                        array('label'=>'Валюты', 'icon'=>'list', 'url'=>array('/backend/currency/index')),
                        array('label'=>'Пользователи', 'icon'=>'list', 'url'=>array('/backend/users/index')),
                    )),
                    array('label'=>'Структура', 'url'=>'#', 'items'=>array(
                        array('label'=>'Бренды', 'icon'=>'list', 'url'=>array('/backend/brands/index')),
                        array('label'=>'Категории', 'icon'=>'list', 'url'=>array('/backend/categories/index')),
                        array('label'=>'Атрибуты', 'icon'=>'list', 'url'=>array('/backend/attributes/index')),
                        array('label'=>'Группы атрибутов', 'icon'=>'list', 'url'=>array('/backend/attributegroup/index')),
                    )),
                    array('label'=>'Модули', 'url'=>'#', 'items'=>array(
                        array('label'=>'Акционные наборы', 'icon'=>'list', 'url'=>array('/promokit/backend/index')),
                        array('label'=>'Страницы', 'icon'=>'list', 'url'=>array('/page/backend/index')),
                        array('label'=>'Новости магазина', 'icon'=>'list', 'url'=>array('/news/backend/index')),
                        array('label'=>'Главная страница', 'icon'=>'list', 'url'=>array('/mainpage/backend/index')),
                        array('label'=>'Контактные данные', 'icon'=>'list', 'url'=>array('/contacts/backend/index')),
                    )),
					array('label'=>'Настройка', 'url'=>array('/backend/config/index')),
				),
			),
			array(
				'class'=>'bootstrap.widgets.TbMenu',
				'htmlOptions'=>array('class'=>'pull-right'),
				'items'=>array(
					array('label'=>'На сайт', 'url'=>Yii::app()->homeUrl, 'linkOptions' => array('target'=>'_blank')),
					array('label'=>'Выйти', 'url'=>array('/auth/logout')),
				),
			),
		),
	));
?>
<div class="container-fluid content-mt50">
	<div class="row-fluid">
		<div class="span12">
		<?php
			$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				'homeLink' => CHtml::link('Панель управления', array('/backend')),
			));
			echo $content;
		?>
		</div>
	</div>
</div>

</body>
</html>