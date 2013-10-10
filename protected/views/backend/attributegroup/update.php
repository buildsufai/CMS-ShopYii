<?php
$this->pageTitle = $model->name;
$this->breadcrumbs = array( "Группы атрибутов" => array('index'), $this->pageTitle );
?>

<h2>Редактирование группы атрибутов</h2>

<?php
    $this->renderPartial('_form', array('model'=>$model));
?>