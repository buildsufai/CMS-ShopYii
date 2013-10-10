<?php
$this->pageTitle = $model->name;
$this->breadcrumbs=array( "Управление атрибутами" => array('index'), $this->pageTitle );
?>

<h2>Редактирование атрибута</h2>

<?php
    $this->renderPartial('_form', array('model'=>$model));
?>