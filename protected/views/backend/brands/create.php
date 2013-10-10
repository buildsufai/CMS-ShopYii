<?php
$this->pageTitle = "Новый бренд";
$this->breadcrumbs=array("Управление брендами" => array('index'), $this->pageTitle);
?>

<h2><?=$this->pageTitle;?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>