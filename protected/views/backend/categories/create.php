<?php
$this->pageTitle = "Новая категория товара";
$this->breadcrumbs=array("Категории товаров" => array('index'), $this->pageTitle);
?>

<h2><?=$this->pageTitle;?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>