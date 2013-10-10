<?php

class BackendController extends BackendMainController
{
	public $_model = "News";

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
}
