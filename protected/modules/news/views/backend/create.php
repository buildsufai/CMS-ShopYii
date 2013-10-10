<?php
$this->pageTitle = "Новая новость";
$this->breadcrumbs=array("Новости" => array('index'), $this->pageTitle);
?>

<h2><?=$this->pageTitle;?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>