<?php
$this->pageTitle = $model->name;
$this->breadcrumbs=array( "Акционные наборы" => array('index'), $this->pageTitle );
?>

<h2>Редактирование акционного набора</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>