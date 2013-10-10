<?php
$this->pageTitle = $model->name;
$this->breadcrumbs=array( "Новости" => array('index'), $this->pageTitle );
?>

<h2>Редактирование новости</h2>

<?php
$this->renderPartial('tabsMenu', array('model'=>$model));
$this->renderPartial('_form', array('model'=>$model));
?>