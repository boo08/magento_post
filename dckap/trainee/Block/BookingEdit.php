<?php
namespace dckap\trainee\Block;

class BookingEdit extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
       \dckap\trainee\Model\BookingFactory $Booking,                 \Magento\Framework\App\Request\Http $request,        
        array $data = []
    ) {
        $this->_bookingCollection = $Booking;      
        $this->_request = $request;     
        parent::__construct($context, $data);
        
    }

    public function getFormAction()
    {
        return $this->getUrl('customer/index/bookingedit/', ['_secure' => true]);
       
    }
    public function getBooking()
    {
        $id = $this->_request->getParam('id');
        
        $postData = $this->_bookingCollection->create();
        $result = $postData->load($id);
        $result = $result->getData();
        return $result;

    }

}
