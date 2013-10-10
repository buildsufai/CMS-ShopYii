<?php
$this->pageTitle = $model->name;
$this->breadcrumbs=array( "Категории товаров" => array('index'), $this->pageTitle );
?>

<h2>Редактирование категории товара</h2>

<?php
    $this->renderPartial('_form', array('model'=>$model));
?>