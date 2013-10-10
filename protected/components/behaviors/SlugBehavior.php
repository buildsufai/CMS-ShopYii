<?php
/*
 * Usage example:
			'SlugBehavior' => array(
				'class' => 'ext.aii.behaviors.SlugBehavior',
				'sourceAttribute' => 'title',
				'slugAttribute' => 'slug',
			),
 *
 */
class SlugBehavior extends CActiveRecordBehavior
{

    // source slug
    public $sourceAttribute = 'title';
    // result
    public $slugAttribute = 'url_name';

    public $connectionId = 'db';

    public $alwaysConvert = false;

    /**
     * Smiles
     *
     * @var array
     */
    public $smileList = array(
        ')' => '',
        ':)' => '',
        '=)' => '',
        ':' => '',
        '(' => '',
        '(:' => '',
        '(=' => '',
        ':D' => '',
        ':P' => '',
        ':3' => '',
    );


    /**
     * Данные для транслита
     *
     * @var unknown_type
     */
    protected $replaceList = array(
        'э'  => 'je',          'ё'  => 'jo',
        'я' => 'ya',           'ю' => 'yu',
        'ы' => 'y',            'ж' => 'zh',
        'й' => 'y',            'щ' => 'shch',       'ч' => 'ch',        	'ш' => 'sh',
        'э' => 'ea',           'а' => 'a',         	'б' => 'b',            	'в' => 'v',        	'г' => 'g',
        'д' => 'd',            'е' => 'e',          'з' => 'z',            	'и' => 'i',        	'к' => 'k',
        'л' => 'l',            'м' => 'm',          'н' => 'n',            	'о' => 'o',        	'п' => 'p',
        'р' => 'r',            'с' => 's',          'т' => 't',            	'у' => 'u',        	'ф' => 'f',
        'х' => 'h',            'ц' => 'c',          'э' => 'e',            	'ь' => '',        	'ъ' => '',
        'й' => 'y',            'Э' => 'JE',        	'Ё' => 'JO',
        'Я' => 'YA',
        'Ю' => 'YU',
        'Ы' => 'Y',
        'Ж' => 'ZH',        	'Й' => 'Y',           'Щ' => 'SHCH',         'Ч' => 'CH',
        'Ш' => 'SH',        	'Э' => 'E',           'А' => 'A',            'Б' => 'B',
        'В' => 'V',             'Г' => 'G',           'Д' => 'D',            'Е' => 'E',        'З' => 'Z',
        'И' => 'I',             'К' => 'K',           'Л' => 'L',            'М' => 'M',        'Н' => 'N',
        'О' => 'O',             'П' => 'P',           'Р' => 'R',            'С' => 'S',        'Т' => 'T',
        'У' => 'U',             'Ф' => 'F',           'Х' => 'H',            'Ц' => 'C',        'Э' => 'E',
        'Ь' => '',            	'Ъ' => '',            'Й' => 'Y',
    );

    public $cleanList = array(
        '`&([a-z]+)(acute|grave|circ|cedil|tilde|uml|lig|ring|caron|slash);`i' => '\1',
        '`&(amp;)?[^;]+;`i' => '-',
        '`[^a-z0-9]`i' => '-',
        '`[-]+`' => '-',
    );

    /**
     * Responds to {@link CModel::onBeforeSave} event.
     * Sets the values of the creation or modified attributes as configured
     *
     * @param CModelEvent event parameter
     */
    public function beforeSave($event)
    {
        $this->getOwner()->{$this->slugAttribute} = empty( $this->getOwner()->{$this->slugAttribute} ) || $this->alwaysConvert ?
            $this->convertToSlug($this->getOwner()->{$this->sourceAttribute}) : $this->convertToSlug($this->getOwner()->{$this->slugAttribute});
    }

    /*
    public function afterSave($event)
    {
        // add "-$id" to slug string to prevent collision
        if($this->getOwner()->isNewRecord)
        {
            $this->getOwner()->{$this->slugAttribute} = $this->getOwner()->{$this->slugAttribute}."-".Yii::app()->{$this->connectionId}->getLastInsertID();
            $this->getOwner()->isNewRecord = false;
            $this->getOwner()->update();
        }
    } */

    /*
     * Get translited 'slug'
     * @param string title
     * @return string slug
     */
    protected function convertToSlug($source)
    {

        $source = str_replace(array_keys($this->replaceList), array_values($this->replaceList), $source);
        $source = htmlentities($source, ENT_COMPAT, 'UTF-8');
        $source = preg_replace(array_keys($this->cleanList), array_values($this->cleanList), $source);
        $source = strtolower(trim($source, '-'));

        return $source;
    }

}
