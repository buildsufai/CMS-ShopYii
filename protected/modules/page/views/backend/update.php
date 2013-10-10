<?php
$this->pageTitle = $model->name;
$this->breadcrumbs=array( "Статические страницы" => array('index'), $this->pageTitle );
?>

<h2>Редактирование статической страницы</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>