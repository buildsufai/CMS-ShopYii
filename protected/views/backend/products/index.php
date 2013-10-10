<?php
$this->pageTitle = "Товары";
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
	'id'=>'products-grid',
    'type'=>'striped',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'template'=>'{summary}{items}{pager}',
    'enablePagination' => true,
	'columns'=>array(
        array(
            'name' => 'article',
            'value'=> '$data->article',
            'header' => 'Артикул',
            'htmlOptions'=>array('width'=>'100px', 'style'=>'text-align: center;'),
        ),
		array(
            'name' => 'name',
            'type' => 'raw',
            'value'=> 'CHtml::link(CHtml::encode($data->name), array("update","id" => $data->id))',
			'header' => 'Имя продукта'
		),
        array(
            'name' => 'brandName',
            'type' => 'raw',
            'value'=> '$data->brandName',
            'header' => 'Бренд',
            'filter' => Brand::getItems(),
        ),
        array(
            'name' => 'price',
            'value'=> '$data->priceNow',
            'header' => 'Цена',
            'htmlOptions'=>array('width'=>'100px', 'style'=>'text-align: center;'),
        ),
        array(
            'name' => 'active',
            'value'=> 'Product::getStatus($data->active)',
            'filter' => Product::getStatus(),
            'header' => 'Статус',
            'htmlOptions'=>array('width'=>'130px'),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{view} {uploads} {delete}',
            'htmlOptions'=>array('style'=>'width: 40px'),
            'buttons'=>array
            (
                'view' => array
                (
                    'url'=>'$data->url',
                    'options' => array('target' => '_blank')
                ),
                'uploads' => array
                (
                    'icon' => 'hdd',
                    'label' => 'Ресурсы',
                    'url'=>'Yii::app()->controller->createUrl("uploads", array("id"=>$data->id))',
                ),
            ),
        ),
	),
)); ?>
