<?php
$this->pageTitle = "Ресурсы";
$this->breadcrumbs=array($this->pageTitle);
?>

<h2><?=$this->pageTitle;?></h2>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
	'block'=>false, // display a larger alert block?
	'fade'=>false, // use transitions?
	'closeText'=>false, // close link text - if set to false, no close link is displayed
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'uploads-grid',
    'type'=>'striped',
    'dataProvider'=>$model->search(),
    'filter' => $model,
    'template'=>'{summary}{items}{pager}',
    'enablePagination' => true,
	'columns'=>array(
        array(
            'name' => 'name',
            'type' => 'raw',
            'value'=> 'CHtml::link($data->name, array("view","id" => $data->id))',
            'header' => 'Имя ресурса',
        ),
        array(
            'name' => 'parentName',
            'type' => 'raw',
            'value'=> '$data->parentName',
            'header' => 'Имя родителя',
        ),
        array(
            'name' => 'parent_model',
            'value'=> 'Upload::getTypes($data->parent_model)',
            'filter' => Upload::getTypes(),
            'header' => 'Тип родителя',
            'htmlOptions' => array('style' => 'text-align: center'),
        ),
        array(
            'name' => 'role',
            'value'=> 'Upload::getRoles($data->role)',
            'filter' => Upload::getRoles(),
            'header' => 'Роль ресурса',
            'htmlOptions' => array('style' => 'text-align: center'),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{view} {delete}',
            'htmlOptions'=>array('style'=>'width: 40px'),
        ),
	),
)); ?>
