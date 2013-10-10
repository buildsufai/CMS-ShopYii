<?php
$this->pageTitle = $model->name;
$this->breadcrumbs=array( "Валюты" => array('index'), $this->pageTitle );
?>

<h2>Редактирование валюты</h2>

<?php
    $this->renderPartial('_form', array('model'=>$model));
?>