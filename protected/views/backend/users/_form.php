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

        <legend>Общая информация</legend>
        <?php echo $form->textFieldRow($model, 'surname', array('class'=>'span12')); ?>
        <?php echo $form->textFieldRow($model, 'name', array('class'=>'span12')); ?>
        <?php echo $form->textFieldRow($model, 'firstname', array('class'=>'span12')); ?>
        <?php echo $form->textFieldRow($model, 'phone', array('class'=>'span12')); ?>
        <?php echo $form->textAreaRow($model, 'address', array('class'=>'span12')); ?>
        <?php echo $form->checkboxRow($model, 'banned'); ?>

        <legend>Данные доступа</legend>
        <?php echo $form->textFieldRow($model, 'email', array('class'=>'span12')); ?>
        <?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span12','value'=>'')); ?>
        <?php echo $form->passwordFieldRow($model, 'confirm_password', array('class'=>'span12','value'=>'')); ?>
        <?php echo $form->dropDownListRow($model, 'role', User::getPrivilege(), array('class'=>'span12')); ?>

        <? if(!$model->isNewRecord) { ?>
            <legend>Отметки времени</legend>
            <?php echo $form->uneditableRow($model, 'date_lastvisit', array('class'=>'span12')); ?>
            <?php echo $form->uneditableRow($model, 'date_create', array('class'=>'span12')); ?>
            <?php echo $form->uneditableRow($model, 'date_update', array('class'=>'span12')); ?>
        <? } ?>
    </fieldset>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить')); ?>
        <?php if(!$model->isNewRecord) $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>array('delete', 'id'=>$model->id), 'type'=>'danger', 'label'=>'Удалить', 'htmlOptions'=> array('onClick'=>"if(!confirm('Вы уверены, что хотите удалить данный элемент?')) return false;"))); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>'', 'label'=>'Назад', 'htmlOptions'=>array('onclick'=>'js:history.go(-1);returnFalse;'))); ?>
    </div>

<?php $this->endWidget(); ?>

