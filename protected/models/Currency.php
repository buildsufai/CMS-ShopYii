<?php

/**
 * This is the model class for table "{{currency}}".
 *
 * The followings are the available columns in table '{{currency}}':
 * @property string $id
 * @property integer $rate
 * @property string $name
 * @property string $symbol
 * @property string $position_symbol
 * @property string $iso_code
 * @property integer $main
 * @property string $date_create
 * @property string $date_update
 */
class Currency extends CActiveRecord
{

    // Метка валюты по умолчанию в гриде
    const SP_MAIN_LABEL = "По умолчанию";

    const SP_RIGHT = "r";
    const SP_LEFT = "l";

    const ROUND_PENNY= "p";
    const ROUND_CEIL = "c";

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{currency}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rate, name, position_symbol, iso_code, rounding, percentage', 'required'),
			array('main, percentage', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('symbol', 'length', 'max'=>45),
			array('position_symbol', 'length', 'max'=>1),
			array('iso_code', 'length', 'max'=>3),
            array('rate', 'match', 'pattern'=>'(^[0-9.]*$)', 'message'=>'Поле «{attribute}» имеет не верный формат. Пример 12.3456'),
		);
	}

    public function behaviors(){
        return array(
            // Обновляет даты создания и обновления
            'VTimestampBehavior' => array(
                'class' => 'application.components.behaviors.VTimestampBehavior',
                'createAttribute' => 'date_create',
                'updateAttribute' => 'date_update',
                'setUpdateOnCreate' => true,
            ),
        );
    }

    public function scopes()
    {
        return array(
            'main'=>array(
                'condition'=>'t.main=1',
            )
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'rate' => 'Курс',
            'name' => 'Название',
            'symbol' => 'Символ',
            'rounding' => 'Округлять',
            'percentage' => 'Процент',
            'position_symbol' => 'Размещение символа',
            'iso_code' => 'ISO Код',
            'main' => 'Сделать валютой по умолчанию',
			'date_create' => 'Создано',
			'date_update' => 'Обновлено',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('rate',$this->rate);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('symbol',$this->symbol,true);
		$criteria->compare('iso_code',$this->iso_code,true);
		$criteria->compare('main',$this->main);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize' => Yii::app()->params['countOnPage'],
            ),
            'sort'=>array(
                'defaultOrder'=>'main DESC',
                'attributes' => array(
                    'name',
                    'symbol',
                    'rate',
                    'iso_code',
                ),
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Currency the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    public function beforeSave()
    {
        $this->iso_code = mb_strtoupper($this->iso_code);

        if($this->main && parent::beforeSave())
        {
            $connection = Yii::app()->db;
            $transaction=$connection->beginTransaction();
            try
            {
                $connection->createCommand("UPDATE {{currency}} SET `main`=0, `rate`='0.0000' WHERE `main`=1")->execute();
                $this->rate = '1.0000';
                $transaction->commit();

                return true;
            }
            catch(Exception $e) // в случае возникновения ошибки при выполнении одного из запросов выбрасывается исключение
            {
                $transaction->rollback();
                $this->addError('error_create_attribute_value_item', "Упс, что-то пошло не так=( Дополнительно: ". $e);
                return false;
            }
        }
        return parent::beforeSave();
    }

    // Получение цены
    private function getCurrency($default = false)
    {
        $code = Yii::app()->session['currency'];
        return self::model()->findByAttributes( (empty($code) || $default)? array('main'=>1) : array('iso_code'=>mb_strtoupper($code)) );
    }

    // Округление до большего
    private function round_up($num, $d = 0)
    {
        $num = $num ? ($num > 0? 1 : -1 ) : 0;
        $p_ceil = ceil( abs($num) * pow(10, $d)) / pow(10, $d);
        return $num * $p_ceil;
    }

    // Рассчет цены
    public function calculatePrice($price, $sale = 0, $default = false)
    {
        $currency = self::getCurrency($default);
        $result = $price * $currency->rate * (1 + ($currency->percentage / 100));

        if($sale > 0)
            $result = $result * ( 1 - $sale / 100);

        return $result;
    }

    // Форматирование цены
    public function formatingPrice($price, $default = false)
    {
        $currency = self::getCurrency($default);

        $result_round = ($currency->rounding == "c")? ceil($price) : $this->round_up($price, 2);

        $sp_left = ($currency->position_symbol == self::SP_LEFT)? "{$currency->symbol} " : "";
        $sp_right = ($currency->position_symbol == self::SP_RIGHT)? " {$currency->symbol}" : "";

        return "{$sp_left}{$result_round}{$sp_right}";
    }


    public function getPositionSymbol($id = null)
    {
        $arrayItems = array(
            self::SP_RIGHT => 'Справа от суммы',
            self::SP_LEFT  => 'Слева от суммы',
        );
        return ($id==null)? $arrayItems : $arrayItems[$id];
    }

    public function getRounding($id = null)
    {
        $arrayItems = array(
            self::ROUND_CEIL  => 'Без копеек (3.171 = 4)',
            self::ROUND_PENNY    => 'С копейками (3.171 = 3.18)',
        );
        return ($id==null)? $arrayItems : $arrayItems[$id];
    }
}
