<?php

class ProductsController extends BackendMainController
{
    public $_model = "Product";

    /**
     * Creates a new model.
     */
    public function actionCreate()
    {
        $model=new $this->_model;

        if(isset($_POST[$this->_model]))
        {

            $transaction = $model->dbConnection->beginTransaction();
            try
            {
                $model->attributes=$_POST[$this->_model];

                $categories = array();
                if(count($categoriesList = $_POST[$this->_model]['categories']) > 0)
                foreach($categoriesList as $id)
                    $categories[] = $id;
                $model->categories = $categories;

                $featuredProducts = array();
                if(count($featuredProductsList = $_POST[$this->_model]['featuredProducts']) > 0)
                    foreach($featuredProductsList as $id)
                        $featuredProducts[] = $id;
                $model->featuredProducts = $featuredProducts;

                if($model->save())
                {
                    // Создаем новые атрибуты
                    if(!$this->createAttributeValue($model))
                        throw new CDbException('Error create attribute value item');
                    else{
                        $transaction->commit();
                        Yii::app()->user->setFlash('success', self::SUCCESS_ALERT_CREATE);
                        $this->redirect(array('update','id'=>$model->id));
                    }
                }
            }
            catch(Exception $e)
            {
                $transaction->rollback();
                $model->addError('error_create_attribute_value_item', "Упс, что-то пошло не так=( Дополнительно: ". $e);
            }
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($this->_model, $id);

        if(isset($_POST[$this->_model]))
        {
            $transaction=$model->dbConnection->beginTransaction();
            try
            {

                $group_id = $_POST[$this->_model]['attr_group_id'];

                if($model->attr_group_id != $group_id)
                {
                    $model->attr_group_id = $group_id;

                    // Удаляем старые и Создаем новые атрибуты
                    if(!AttributeValue::model()->deleteAll( array('condition'=> 'product_id = '.$model->id) ) || !$this->createAttributeValue($model))
                        throw new CDbException('Error create attribute value item');
                }

                // Обновление значений атрибутов
                if($attr_value = $_POST['Attribute'])
                {
                    foreach($attr_value as $id=>$value)
                    {
                        $attr_model = AttributeValue::model()->findByPk($id);
                        if($attr_model===null) break;
                        $attr_model->value = $value;
                        if(!$attr_model->save())
                            throw new CDbException('Error update attribute value item');
                    }
                }

                $model->attributes = $_POST[$this->_model];

                $categories = array();
                if(count($categoriesList = $_POST[$this->_model]['categories']) > 0)
                    foreach($categoriesList as $id)
                        $categories[] = $id;
                $model->categories = $categories;

                $featuredProducts = array();
                if(count($featuredProductsList = $_POST[$this->_model]['featuredProducts']) > 0)
                    foreach($featuredProductsList as $id)
                        $featuredProducts[] = $id;
                $model->featuredProducts = $featuredProducts;

                if($model->save())
                {
                    $transaction->commit();
                    Yii::app()->user->setFlash('success', self::SUCCESS_ALERT_UPDATE);
                }
            }
            catch(Exception $e)
            {
                $transaction->rollback();
                $model->addError('error_create_attribute_value_item', "Упс, что-то пошло не так=( Дополнительно: ". $e);
            }
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    public function actionUploads($id)
    {
        $model=$this->loadModel($this->_model, $id);
        $upload = new Upload();

        if(isset($_POST['Upload']))
        {
            $upload->attributes = $_POST['Upload'];
            $upload->parent_id = $model->id;
            $upload->parent_model = strtolower($this->_model);
            if($upload->save())
                $this->refresh();
        }

        $dataProvider = new CArrayDataProvider($model->uploads, array(
            'id'=>'uploads',
            'sort'=>array(
                'attributes'=>array(
                    'name', 'role', 'filename'
                ),
            ),
        ));

        $this->render('uploads',array(
            'model'=>$model, 'dataProvider'=>$dataProvider, 'upload' => $upload
        ));
    }


    public function createAttributeValue($model)
    {
        $group_model = AttributeGroup::model()->findByPk($model->attr_group_id);

        if($group_model === null)
            return false;

        foreach($group_model->listAttributes as $attr)
        {
            $attr_value = new AttributeValue();
            $attr_value->attribute_id = $attr->id;
            $attr_value->product_id = $model->id;
            if(!$attr_value->save())
                return false;
        }

        return true;
    }
}
