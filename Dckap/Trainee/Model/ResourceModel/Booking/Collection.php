<?php
namespace Dckap\Trainee\Model\ResourceModel\Booking;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'entity_id';
	protected $_eventPrefix = 'dckap_trainee_booking_collection';
	protected $_eventObject = 'booking_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dckap\Trainee\Model\Booking', 'Dckap\Trainee\Model\ResourceModel\Booking');
    }
}
