<?php

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

        <?php echo $form->errorSummary($model, "", ""); ?>

        <legend>Свойства валюты</legend>
        <?php echo $form->textFieldRow($model, 'name', array('class'=>'span12')); ?>
        <?php echo $form->textFieldRow($model, 'rate', array('class'=>'span12', 'hint'=>'Курс по отношению к валюте по умолчанию.')); ?>
        <?php echo $form->textFieldRow($model, 'percentage', array('class'=>'span12', 'hint'=>'Сколько процентов от конечной суммы товара прибавить к ней же. Например: 30.')); ?>
        <?php echo $form->dropDownListRow($model, 'rounding', $model->getRounding(), array('class'=>'span12')); ?>
        <?php echo $form->textFieldRow($model, 'symbol', array('class'=>'span12')); ?>
        <?php echo $form->dropDownListRow($model, 'position_symbol', $model->getPositionSymbol(), array('class'=>'span12')); ?>
        <?php echo $form->textFieldRow($model, 'iso_code', array('class'=>'span12')); ?>
        <?php echo $form->checkboxRow($model, 'main'); ?>

    </fieldset>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить')); ?>
        <?php if(!$model->isNewRecord) $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>array('delete', 'id'=>$model->id), 'type'=>'danger', 'label'=>'Удалить', 'htmlOptions'=> array('onClick'=>"if(!confirm('Вы уверены, что хотите удалить данный элемент?')) return false;"))); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>'', 'label'=>'Назад', 'htmlOptions'=>array('onclick'=>'js:history.go(-1);returnFalse;'))); ?>
    </div>

<?php $this->endWidget(); ?>

