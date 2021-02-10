<?php
// @changed 8.02.2021
namespace frontend\components;

use Yii;

class DeviceDetect extends \yii\base\Component {
	/**
	* @var MobileDetect
	*/
	private $_mobileDetect;

	/** detecting by User-Agent */
	private $_userAgent;

	// Automatically set view parameters based on device type
	public $setParams = true;

	// Automatically set alias parameters based on device type
	public $setAlias = true;

	private $isMobile = false;

	private $isMobileLayout = false;

	

	public function __call($name, $parameters) {
		return call_user_func_array(
			array($this->_mobileDetect, $name),
			$parameters
		);
	}

	public function __construct($config = array()) {
		parent::__construct($config);
	}

	public function init() {
		$this->_mobileDetect = new MobileDetect();
		$this->_userAgent = Yii::$app->request->headers->get('user-agent');
		$this->isMobile = $this->_mobileDetect->isMobile($this->_userAgent);
        parent::init();

    }
    
    public function isMobile() {
		return $this->isMobile;
	}

	public function setMobileLayout($layout)
	{
		$this->isMobileLayout = true;
		return $layout;
	}
	

	public function isMobileLayout()
	{
		return $this->isMobileLayout;
	}
}