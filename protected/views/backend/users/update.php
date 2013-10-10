<?php
$this->pageTitle = $model->name;
$this->breadcrumbs=array( "Пользователи" => array('index'), $this->pageTitle );
?>

<h2>Редактирование пользователя</h2>

<?php
    $this->renderPartial('_form', array('model'=>$model));
?>