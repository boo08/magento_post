<?php
namespace dckap\trainee\Block;

class BookingList extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
	protected $_bookingCollection;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \dckap\trainee\Model\BookingFactory $Booking,
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
    public function getViewUrl()
    {
        return $this->getUrl('customer/index/bookingview');
    }

    /**
     * @return string
     */
    public function getEditPageUrl()
    {
        return $this->getUrl('customer/index/bookingedit');
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('customer/index/bookingdelete');
    }
}
