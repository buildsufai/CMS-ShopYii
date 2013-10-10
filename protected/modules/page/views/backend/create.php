<?php
$this->pageTitle = "Новая статическая страница";
$this->breadcrumbs=array("Статические страницы" => array('index'), $this->pageTitle);
?>

<h2><?=$this->pageTitle;?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>