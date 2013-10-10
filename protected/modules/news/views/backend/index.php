<?php
$this->pageTitle = "Новости";
$this->breadcrumbs=array($this->pageTitle);
?>

<h2><?=$this->pageTitle;?></h2>

<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Создать', 'icon'=>'plus', 'url'=>array('create'))
    ),
));
?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
	'block'=>false, // display a larger alert block?
	'fade'=>false, // use transitions?
	'closeText'=>false, // close link text - if set to false, no close link is displayed
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'pews-grid',
    'type'=>'striped',
    'dataProvider'=>$model->search(),
    'filter' => $model,
    'template'=>"{items}",
	'columns'=>array(
		array(
            'name' => 'name',
            'value'=> 'CHtml::link(CHtml::encode($data->name), array("update","id" => $data->id))',
            'type'=>'raw',
			'header' => 'Название новости'
		),
        array(
            'name' => 'active',
            'value'=> 'News::getStatus($data->active)',
            'filter' => News::getStatus(),
            'header' => 'Статус новости'
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 40px'),
			'template'=>'{view} {delete}',
			'buttons'=>array
			(
				'view' => array
				(
                    'url'=>'Yii::app()->createUrl("news/default/view", array("slug"=>$data->slug))',
					'options' => array('target' => '_blank')
				),
			),
        ),
	),
)); ?>
