<?php
namespace Dckap\Trainee\Model;

class Booking extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    
    const CACHE_TAG = 'dckap_trainee_booking';

	protected $_cacheTag = 'dckap_trainee_booking';

	protected $_eventPrefix = 'dckap_trainee_booking';
  
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dckap\Trainee\Model\ResourceModel\Booking');
    }

    /**
     * Return a unique id for the model.
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    
    public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}
