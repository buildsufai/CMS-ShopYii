<?php

// Подключаем Imperavi редактор
$this->widget('ImperaviRedactorWidget', array(
    // The textarea selector
    'selector' => '.imperaviRedactor',
    // Some options, see http://imperavi.com/redactor/docs/
    'options' => array(
        'lang' => 'ru',
        'minHeight' => 220,
    ),
    'plugins' => array(
        'fullscreen' => array(
            'js' => array('fullscreen.js',),
        ),
        'fontsize' => array(
            'js' => array('fontsize.js',),
        ),
        'fontfamily' => array(
            'js' => array('fontfamily.js',),
        ),
        'fontcolor' => array(
            'js' => array('fontcolor.js',),
        ),
    ),
));

/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'type'=>'horizontal',
)); ?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>false, // display a larger alert block?
    'fade'=>false, // use transitions?
    'closeText'=>false, // close link text - if set to false, no close link is displayed
)); ?>

<fieldset>

    <legend><?=$this->pageTitle;?></legend>

	<?php echo $form->textFieldRow($model, 'name', array('class'=>'span12')); ?>
	<?php echo $form->textAreaRow($model, 'content', array('class'=>'imperaviRedactor')); ?>
    <?php echo $form->checkboxRow($model, 'active'); ?>

    <legend>SEO данные</legend>

    <?php echo $form->textFieldRow($model, 'slug', array('class'=>'span12')); ?>
    <?php echo $form->textFieldRow($model, 'meta_title', array('class'=>'span12')); ?>
	<?php echo $form->textAreaRow($model, 'meta_description', array('class'=>'span12')); ?>
	<?php echo $form->textAreaRow($model, 'meta_keywords', array('class'=>'span12')); ?>

</fieldset>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить')); ?>
    <?php if(!$model->isNewRecord) $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>array('/page/backend/delete', 'id'=>$model->id), 'type'=>'danger', 'label'=>'Удалить', 'htmlOptions'=> array('onClick'=>"if(!confirm('Вы уверены, что хотите удалить данный элемент?')) return false;"))); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>'', 'label'=>'Назад', 'htmlOptions'=>array('onclick'=>'js:history.go(-1);returnFalse;'))); ?>
</div>

<?php $this->endWidget(); ?>