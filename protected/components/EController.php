<?php
/**
 * EController class
 *
 * Has some useful methods for your Controllers
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class EController extends CController
{
    public $layout='//layouts/sidebar_right';

	public $meta_keywords;
	public $meta_description;
	public $breadcrumbs;

    /**
	 * Gets a param
	 * @param $name
	 * @param null $defaultValue
	 * @return mixed
	 */
	public function getActionParam($name, $defaultValue = null)
	{
		return Yii::app()->request->getParam($name, $defaultValue );
	}

    public function loadModel($class, $id)
    {
        $model = CActiveRecord::model($class)->findByPk($id);

        if ($model===null)
            throw new CHttpException(404, 'Запрашиваемой страницы не существует.');

        return $model;
    }

    public function loadModelBySlug($class, $id)
    {
        $model = CActiveRecord::model($class)->findByAttributes( array( 'slug'=>$id ) );

        if ($model===null)
            throw new CHttpException(404, 'Запрашиваемой страницы не существует.');

        return $model;
    }

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === $model->formId)
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Outputs (echo) json representation of $data, prints html on debug mode.
	 * NOTE: json_encode exists in PHP > 5.2, so it's safe to use it directly without checking
	 * @param array $data the data (PHP array) to be encoded into json array
	 * @param int $opts Bitmask consisting of JSON_HEX_QUOT, JSON_HEX_TAG, JSON_HEX_AMP, JSON_HEX_APOS, JSON_FORCE_OBJECT.
	 */
	public function renderJson($data, $opts=null)
	{
		if(YII_DEBUG && isset($_GET['debug']) && is_array($data))
		{
			foreach($data as $type => $v)
				printf('<h1>%s</h1>%s', $type, is_array($v) ? json_encode($v, $opts) : $v);
		}
		else
		{
			header('Content-Type: application/json; charset=UTF-8');
			echo json_encode($data, $opts);
		}
	}

	/**
	 * Utility function to ensure the base url.
	 * @param $url
	 * @return string
	 */
	public function baseUrl( $url = '' )
	{
		static $baseUrl;
		if ($baseUrl === null)
			$baseUrl = Yii::app()->request->baseUrl;
		return $baseUrl . '/' . ltrim($url, '/');
	}

}