<?php
/**
 * DateTimePicker class file.
 *
 * @author Vitaly Voskobovich <vitaly@voskobovich.com>
 * @copyright Copyright &copy; 2013 Vitaly Voskobovich
 * @license Licensed under MIT license. http://ifdattic.com/MIT-license.txt
 * @version 0.0.11
 */

/**
 * DateTimePicker makes select boxes much more user-friendly.
 *
 * @author Vitaly Voskobovich <vitaly@voskobovich.com>
 */
class DateTimePicker extends CWidget
{
    /**
     * @var string apply datetimepicker plugin to these elements.
     */
    public $target = ".datetimepicker";

    /**
    * @var boolean include un-minified plugin then debuging.
    */
    public $debug = false;

    /**
    * @var array native Chosen plugin options.
    */
    public $options = array();

    /**
    * @var int script registration position.
    */
    public $scriptPosition = CClientScript::POS_END;

    /**
    * Apply Chosen plugin to select boxes.
    */
    public function run()
    {
        // Publish extension assets
        $assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/assets' );

        // Register extension assets
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile( "{$assets}/datetimepicker.css" );

        // Get extension for JavaScript file
        $ext = ( $this->debug )?'.min.js':'.js';

        // Register jQuery scripts
        $options = CJavaScript::encode( $this->options );
        $cs->registerScriptFile( "{$assets}/bootstrap-datetimepicker{$ext}", $this->scriptPosition );
        $cs->registerScript( __CLASS__.'#'.$this->id, "$( '{$this->target}' ).datetimepicker({$options});", CClientScript::POS_READY );
    }
}
