<?php
$this->pageTitle = "Новый акционный набор";
$this->breadcrumbs=array("Акционные наборы" => array('index'), $this->pageTitle);
?>

<h2><?=$this->pageTitle;?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>