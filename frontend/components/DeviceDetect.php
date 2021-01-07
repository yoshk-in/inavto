<?php

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
        parent::init();
        
    /** turn off auto detecting; it'll be working by methods on this object in project  */

	// 	if ($this->setParams) {
	// 		\Yii::$app->params['devicedetect'] = [
	// 			'isMobile' => $this->_mobileDetect->isMobile() && !$this->_mobileDetect->isTablet(),
	// 			'isTablet' => $this->_mobileDetect->isTablet() && !$this->_mobileDetect->isMobile(),
	// 			'isDesktop' => !$this->_mobileDetect->isTablet() && !$this->_mobileDetect->isMobile(),
	// 		];
	// 	}

	// 	if ($this->setAlias) {
	// 		if ($this->_mobileDetect->isMobile()) {
	// 			\Yii::setAlias('@device', 'mobile');
	// 		} else if ($this->_mobileDetect->isTablet()) {
	// 			\Yii::setAlias('@device', 'tablet');
	// 		} else {
	// 			\Yii::setAlias('@device', 'desktop');
	// 		}
	// 	}
    // }
    }
    
    public function isMobile() {
		return $this->_mobileDetect->isMobile($this->_userAgent);
    }
}