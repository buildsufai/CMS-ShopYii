<?php
$this->pageTitle = "Новый атрибут";
$this->breadcrumbs=array("Атрибуты" => array('index'), $this->pageTitle);
?>

<h2><?=$this->pageTitle;?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>