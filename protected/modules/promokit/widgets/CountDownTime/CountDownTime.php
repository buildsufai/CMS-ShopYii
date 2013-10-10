<?php
/**
 * CountDownTime class file.
 *
 * @author Vitaly Voskobovich <vitaly@voskobovich.com>
 * @copyright Copyright &copy; 2013 Vitaly Voskobovich
 * @license Licensed under MIT license. http://ifdattic.com/MIT-license.txt
 * @version 0.0.11
 */

/**
 * CountDownTime makes select boxes much more user-friendly.
 *
 * @author Vitaly Voskobovich <vitaly@voskobovich.com>
 */
class CountDownTime extends CWidget
{
    /**
     * @var string stopping date.
     */
    public $target = ".countdowntime";

    /**
     * @var stop date timer.
     */
    public $stopDate = "2014-01-01 00:00:00";

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
        $cs->registerCssFile( "{$assets}/jquery.countdown.css" );

        // Set default date
        $this->options['timestamp'] = strtotime($this->stopDate) *1000;

        // Register jQuery scripts
        $options = CJavaScript::encode( $this->options );

        $cs->registerScriptFile( "{$assets}/jquery.countdown.js", $this->scriptPosition );
        $cs->registerScript( __CLASS__.'#'.$this->id, " $('{$this->target}').countdown($options); ",CClientScript::POS_READY );
    }
}
