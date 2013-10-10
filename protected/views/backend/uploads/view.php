<?php
$this->pageTitle = $model->name;
$this->breadcrumbs=array( "Товары" => array('/backend/products/index'), $model->product->name => array('/backend/products/update', 'id'=>$model->product->id), "Ресурсы" => array('/backend/products/uploads', 'id'=>$model->product->id), $this->pageTitle );
?>

<fieldset>

    <h2>Просмотр ресурса</h2>

    <?php $this->widget('bootstrap.widgets.TbDetailView', array(
        'data'=>$model,
        'attributes' => array(
            array('name'=>'name', 'label'=>'Название'),
            array(
                'name' => 'role',
                'label' => 'Роль ресурса',
                'value' => $model->getRoles($model->role)
            ),
            array(
                'name' => 'parentName',
                'label' => 'Владелец',
                'type' => 'raw',
            ),
            array(
                'name' => 'parent_model',
                'label' => 'Тип владельца',
                'value' => $model->getTypes($model->parent_model)
            ),
            array(
                'name' => 'filename',
                'label' => 'Имя файла',
                'type' => 'raw',
                'value' => CHtml::link( $model->filename, Upload::getUrl($model), array("target"=>"_blank")),
            ),
            array('name'=>'date_create', 'label'=>'Создано'),
        ),
    )); ?>

</fieldset>

<div class="form-actions">
    <?php if(!$model->isNewRecord) $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>array('delete', 'id'=>$model->id), 'type'=>'danger', 'label'=>'Удалить', 'htmlOptions'=> array('onClick'=>"if(!confirm('Вы уверены, что хотите удалить данный элемент?')) return false;"))); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>'', 'label'=>'Назад', 'htmlOptions'=>array('onclick'=>'js:history.go(-1);returnFalse;'))); ?>
</div>