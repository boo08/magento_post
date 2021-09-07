<?php
namespace Dckap\Trainee\Block;

class BookingShow extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
	protected $_bookingCollection;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Dckap\Trainee\Model\BookingFactory $Booking,
        array $data = []
    ) {
        $this->_bookingCollection = $Booking;        
        parent::__construct($context, $data);

    }
    public function getBookings()
    {
        return $this->_bookingCollection->create()->getCollection();
    }

    /**
     * @return string
     */
    public function getAddUrl()
    {
        return $this->getUrl('booking/index/save');
    }
    /**
     * @return string
     */
    public function getViewUrl()
    {
        return $this->getUrl('booking/index/view');
    }

    /**
     * @return string
     */
    public function getEditPageUrl()
    {
        return $this->getUrl('booking/index/edit');
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('booking/index/delete');
    }
}
