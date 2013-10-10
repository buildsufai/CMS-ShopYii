<?php
$this->pageTitle = $model->name;
$this->breadcrumbs=array( "Новости" => array('index'), $this->pageTitle => array('/news/backend/update', 'id'=>$model->id), "Ресурсы" );
?>

<h2>Редактирование новости</h2>

<?php
$this->renderPartial('tabsMenu', array('model'=>$model));

$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>false, // display a larger alert block?
    'fade'=>false, // use transitions?
    'closeText'=>false, // close link text - if set to false, no close link is displayed
));

/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'type'=>'horizontal',
    'htmlOptions' => array('enctype'=>'multipart/form-data')
)); ?>

<fieldset>

    <legend>Создание ресурса</legend>

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>false, // display a larger alert block?
        'fade'=>false, // use transitions?
        'closeText'=>false, // close link text - if set to false, no close link is displayed
    )); ?>

    <?php echo $form->errorSummary($upload,"",""); ?>

    <?php echo $form->textFieldRow($upload, 'name', array('class'=>'span12')); ?>
    <?php echo $form->dropDownListRow($upload, 'role', Upload::getRoles(), array('class'=>'span12')); ?>
    <?php echo $form->fileFieldRow($upload, 'fileObject', array('class'=>'span12')); ?>

</fieldset>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Загрузить')); ?>
</div>

<?php
$this->endWidget();

$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'page-grid',
    'type'=>'striped',
    'dataProvider'=>$dataProvider,
    'template'=>"{items}\n{pager}",
    'columns'=>array(
        array(
            'name' => 'role',
            'value'=> 'Upload::getRoles($data->role)',
            'header' => 'Роль',
        ),
        array(
            'name' => 'filename',
            'value'=> 'CHtml::link( $data->filename, Upload::getUrl($data), array("target"=>"_blank"))',
            'type' => 'raw',
            'header' => 'Имя файла',
        ),
        array(
            'name' => 'name',
            'value'=> '$data->name',
            'header' => 'Имя',
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{view} {delete}',
            'htmlOptions'=>array('style'=>'width: 40px'),
            'buttons'=>array(
                'view' => array(
                    'url'=>'Yii::app()->createUrl("/backend/uploads/view", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'url'=>'Yii::app()->createUrl("/backend/uploads/delete", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
)); ?>
