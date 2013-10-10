<?php

$this->pageTitle = "Главная страница";
$this->breadcrumbs = array($this->pageTitle);

$this->widget( 'ext.EChosenJS.EChosen' );

/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
));
?>

<h2><?=$this->pageTitle;?></h2>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>false, // display a larger alert block?
    'fade'=>false, // use transitions?
    'closeText'=>false, // close link text - if set to false, no close link is displayed
)); ?>

<fieldset>

    <legend>Новость на главной</legend>
    <?php echo $form->dropDownListRow($model, 'news', News::getItems(), array('class'=>'span12')); ?>

    <legend>Продукты на главной</legend>
    <?php echo $form->dropDownListRow($model, 'popular_products', Product::getItems(), array('multiple'=>true, 'class'=>'span12 chzn-select', 'data-placeholder'=>'Выберите продукты')); ?>
    <?php echo $form->dropDownListRow($model, 'new_products', Product::getItems(), array('multiple'=>true, 'class'=>'span12 chzn-select', 'data-placeholder'=>'Выберите продукты')); ?>
 
</fieldset>
 
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>'', 'label'=>'Назад', 'htmlOptions'=>array('onclick'=>'js:history.go(-1);returnFalse;'))); ?>
</div>
 
<?php $this->endWidget(); ?>