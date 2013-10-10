<?php

// Подключаем Imperavi редактор
$this->widget('ImperaviRedactorWidget', array(
    // The textarea selector
    'selector' => '.imperaviRedactor',
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

    <legend>Свойства продукта</legend>
    <?php echo $form->textFieldRow($model, 'name', array('class'=>'span12')); ?>
    <?php echo $form->textFieldRow($model, 'article', array('class'=>'span12')); ?>
    <?php echo $form->textFieldRow($model, 'price', array('class'=>'span12', 'hint' => 'Цена указывается в единицах главной валюты магазина, узнать которую можно '.Chtml::link("здесь",array("/backend/currency/index")))); ?>
    <?php echo $form->textFieldRow($model, 'amount', array('class'=>'span12')); ?>
	<?php echo $form->textAreaRow($model, 'description', array('class'=>'imperaviRedactor')); ?>
    <?php echo $form->checkboxRow($model, 'active'); ?>

    <? if(count($model->attrValue) > 0){ ?>
    <legend>Атрибуты товара</legend>
    <?php foreach ($model->attrValue as $item){ ?>
        <div class="control-group">

            <?php
            switch($item->attr->type_field):
                case Attribute::TYPEF_MULTILINE : {
                    ?>
                    <label class="control-label required" for="Attribute_<?=$item->attr->slug;?>"> <?=$item->attr->name;?> </label>
                    <div class="controls">
                        <textarea class="imperaviRedactor" name="Attribute[<?=$item->id;?>]" id="Attribute_<?=$item->attr->slug;?>"> <?=$item->value?> </textarea>
                    </div>
                <?php
                }
                    break;
                case Attribute::TYPEF_CHECKBOX : {
                    ?>
                    <div class="control-group ">
                        <div class="controls">
                            <label class="checkbox" for="Attribute_<?=$item->attr->slug;?>">
                                <input type="hidden" value="0" name="Attribute[<?=$item->id;?>]"/>
                                <input type="checkbox" value="1" name="Attribute[<?=$item->id;?>]" id="Attribute_<?=$item->attr->slug;?>" <?=($item->value)?'checked="checked"':''?> />
                                <?=$item->attr->name;?>
                            </label>
                        </div>
                    </div>
                <?php
                }
                    break;
                default : {
                ?>
                    <label class="control-label required" for="Attribute_<?=$item->attr->slug;?>"> <?=$item->attr->name;?> </label>
                    <div class="controls">
                        <input class="span12" name="Attribute[<?=$item->id;?>]" id="Attribute_<?=$item->attr->slug;?>" type="text" maxlength="200" value="<?=$item->value?>">
                    </div>
                <?php
                }
            endswitch;
            ?>
        </div>
    <?php }
    }?>

    <legend>Параметры товара</legend>
    <?php echo $form->dropDownListRow($model, 'brand_id', Brand::getItems(), array('class'=>'span12')); ?>
    <?php echo $form->dropDownListRow($model, 'attr_group_id', AttributeGroup::getItems(), array('class'=>'span12')); ?>
    <?php echo $form->dropDownListRow($model, 'categories', Category::getItems(), array('multiple'=>true, 'class'=>'span12 chzn-select', 'data-placeholder'=>'Выберите одну или больше категорий', 'hint' => 'Первая выбранная категория является главной и в некоторых случаях отображается в хлебных крошках')); ?>
    <?php echo $form->dropDownListRow($model, 'featuredProducts', CHtml::listData($model->getFeaturedProductsList(),'id','name'), array('multiple'=>true, 'class'=>'span12 chzn-select', 'data-placeholder'=>'Укажите рекомендуемые товары')); ?>

    <legend>SEO данные</legend>
    <?php echo $form->textFieldRow($model, 'slug', array('class'=>'span12')); ?>
    <?php echo $form->textFieldRow($model, 'meta_title', array('class'=>'span12')); ?>
	<?php echo $form->textAreaRow($model, 'meta_description', array('class'=>'span12')); ?>
	<?php echo $form->textAreaRow($model, 'meta_keywords', array('class'=>'span12')); ?>

</fieldset>
 
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить')); ?>
    <?php if(!$model->isNewRecord) $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>$model->url, 'type'=>'warning', 'label'=>'Открыть', 'htmlOptions'=> array('target' => '_blank'))); ?>
    <?php if(!$model->isNewRecord) $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>array('delete', 'id'=>$model->id), 'type'=>'danger', 'label'=>'Удалить', 'htmlOptions'=> array('onClick'=>"if(!confirm('Вы уверены, что хотите удалить данный элемент?')) return false;"))); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link','url'=>'', 'label'=>'Назад', 'htmlOptions'=>array('onclick'=>'js:history.go(-1);returnFalse;'))); ?>
</div>
 
<?php $this->endWidget(); ?>