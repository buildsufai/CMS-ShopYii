<?php
$this->pageTitle = "Новый пользователь";
$this->breadcrumbs=array("Пользователи" => array('index'), $this->pageTitle);
?>

<h2><?=$this->pageTitle;?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>