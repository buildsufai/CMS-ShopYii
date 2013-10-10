<?php
$this->pageTitle = "Валюты";
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
	'id'=>'attributes-grid',
    'type'=>'striped',
    'dataProvider'=>$model->search(),

    'template'=>'{summary}{items}{pager}',
    'enablePagination' => true,

	'columns'=>array(
		array(
            'name' => 'name',
            'type' => 'raw',
            'value'=> 'CHtml::link($data->name.($data->main?" - ".Currency::SP_MAIN_LABEL:""), array("update", "id" => $data->id))',
            'header' => 'Имя валюты'
        ),
        array(
            'name' => 'symbol',
            'header' => 'Символ'
        ),
        array(
            'name' => 'rate',
            'cssClassExpression' => '($data["rate"] == 0) ? "invadidValue" : ""',
            'header' => 'Курс'
        ),
        array(
            'name' => 'iso_code',
            'header' => 'ISO код'
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{update} {delete}',
            'htmlOptions'=>array('style'=>'width: 40px'),
        ),
	),
)); ?>
