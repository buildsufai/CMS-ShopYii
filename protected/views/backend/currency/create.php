<?php
$this->pageTitle = "Новая валюта";
$this->breadcrumbs=array("Валюты" => array('index'), $this->pageTitle);
?>

<h2><?=$this->pageTitle;?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>