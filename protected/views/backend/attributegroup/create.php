<?php
$this->pageTitle = "Новая группа атрибутов";
$this->breadcrumbs=array("Группы атрибутов" => array('index'), $this->pageTitle);
?>

<h2><?=$this->pageTitle?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>