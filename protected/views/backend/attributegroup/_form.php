<?php

$this->widget( 'ext.EChosenJS.EChosen' );

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

        <legend>Свойства группы</legend>

        <?php echo $form->textFieldRow($model, 'name', array('class'=>'span12')); ?>
        <?php echo $form->dropDownListRow($model, 'listAttributes', Attribute::getItems(), array('multiple'=>true, 'class'=>'span12 chzn-select', 'data-placeholder'=>'Укажите дополнительные атрибуты')); ?>

    </fieldset>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить')); ?>
        <?php if(!$model->isNewRecord) $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>array('delete', 'id'=>$model->id), 'type'=>'danger', 'label'=>'Удалить', 'htmlOptions'=> array('onClick'=>"if(!confirm('Вы уверены, что хотите удалить данный элемент?')) return false;"))); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>'', 'label'=>'Назад', 'htmlOptions'=>array('onclick'=>'js:history.go(-1);returnFalse;'))); ?>
    </div>

<?php $this->endWidget(); ?>

