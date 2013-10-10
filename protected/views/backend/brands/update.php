<?php
$this->pageTitle = $model->name;
$this->breadcrumbs=array( "Бренды" => array('index'), $this->pageTitle );
?>

<h2>Редактирование бренда</h2>

<?php
    $this->renderPartial('_form', array('model'=>$model));
?>