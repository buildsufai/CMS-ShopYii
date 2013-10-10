<?php
$this->pageTitle = $model->name;
$this->breadcrumbs=array( "Товары" => array('index'), $this->pageTitle );
?>

<h2>Редактирование товара</h2>

<?php
    $this->renderPartial('tabsMenu', array('model'=>$model));
    $this->renderPartial('_form', array('model'=>$model));
?>