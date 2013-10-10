<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Виталий
 * Date: 14.09.13
 * Time: 9:53
 * To change this template use File | Settings | File Templates.
 */

$this->widget('bootstrap.widgets.TbMenu', array(
        'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
        'stacked'=>false, // whether this is a stacked menu
        'items'=>array(
            array('label'=>'Свойства', 'url'=>array('update','id'=>$model->id), 'active'=>Yii::app()->controller->action->id=='update'),
            array('label'=>'Ресурсы', 'url'=>array('uploads','id'=>$model->id), 'active'=>Yii::app()->controller->action->id=='uploads'),
        ),
));