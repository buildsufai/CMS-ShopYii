<?php
$this->pageTitle = "Акционные наборы";
$this->breadcrumbs=array($this->pageTitle);
$this->widget( 'ext.DateTimePicker.DateTimePicker', array( 'options' => array('autoclose' => true, 'language'=>'ru')) );
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
	'id'=>'page-grid',
    'type'=>'striped',
    'dataProvider'=>$model->search(),
    'filter' => $model,
    'template'=>'{summary}{items}{pager}',
    'enablePagination' => true,
	'columns'=>array(
		array(
            'name' => 'name',
            'value'=> 'CHtml::link(CHtml::encode($data->name), array("update","id" => $data->id))',
            'type'=>'raw',
			'header' => 'Название набора'
		),
        array(
            'name' => 'percentage',
            'value'=> '$data->percentage."%"',
            'header' => 'Размер скидки'
        ),
        array(
            'name' => 'stop',
            'filter'=>CHtml::textField('PromoKit[stop]', "{$model->stop}", array('class'=>'datetimepicker')),
            'value'=> 'date("d.m.Y H:i:s", strtotime($data->stop))',
            'header' => 'Дата окончания'
        ),
		array(
			'name' => 'active',
			'value'=> 'PromoKit::getStatus($data->active)',
            'filter' => PromoKit::getStatus(),
			'header' => 'Статус набора'
		),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 40px'),
			'template'=>'{view} {delete}',
			'buttons'=>array
			(
				'view' => array
				(
					'url'=>'Yii::app()->createUrl("/promokit/default/view", array("slug"=>$data->slug))',
					'options' => array('target' => '_blank')
				),
			),
        ),
	),
)); ?>
