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

        <legend>Свойства атрибута</legend>

        <?php echo $form->textFieldRow($model, 'name', array('class'=>'span12')); ?>
        <?php echo $form->dropDownListRow($model, 'type_field', $model->getFieldTypes(), array('class'=>'span12')); ?>
        <?php echo $form->dropDownListRow($model, 'type_attr', $model->getAttrTypes(), array('class'=>'span12')); ?>
    </fieldset>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить')); ?>
        <?php if(!$model->isNewRecord) $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>array('delete', 'id'=>$model->id), 'type'=>'danger', 'label'=>'Удалить', 'htmlOptions'=> array('onClick'=>"if(!confirm('Вы уверены, что хотите удалить данный элемент?')) return false;"))); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>'', 'label'=>'Назад', 'htmlOptions'=>array('onclick'=>'js:history.go(-1);returnFalse;'))); ?>
    </div>

<?php $this->endWidget(); ?>

