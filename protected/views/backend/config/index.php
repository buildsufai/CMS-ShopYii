<?php

$this->pageTitle = "Параметры системы";
$this->breadcrumbs = array($this->pageTitle);
?>
    <h2><?=$this->pageTitle;?></h2>
<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>
 
<fieldset>

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>false, // display a larger alert block?
        'fade'=>false, // use transitions?
        'closeText'=>false, // close link text - if set to false, no close link is displayed
    )); ?>

    <legend>SEO данные</legend>
 
    <?php echo $form->textFieldRow($model, 'meta_title', array('class'=>'span12')); ?>
	<?php echo $form->textFieldRow($model, 'meta_keywords', array('class'=>'span12')); ?>
	<?php echo $form->textAreaRow($model, 'meta_description', array('class'=>'span12')); ?>

</fieldset>
 
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Сбросить')); ?>
</div>
 
<?php $this->endWidget(); ?>