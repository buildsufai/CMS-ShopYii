<?php
$this->pageTitle = "Создание товара";
$this->breadcrumbs=array("Товары" => array('index'), $this->pageTitle);
?>

<h2>Новый товар</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>