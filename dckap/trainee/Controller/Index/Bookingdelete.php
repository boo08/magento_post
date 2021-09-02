<?php
namespace dckap\trainee\Controller\Index;

class Bookingdelete extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
	protected $_Booking;
    protected $_request;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory, \dckap\trainee\Model\BookingFactory $Booking,                 \Magento\Framework\App\Request\Http $request
    )
    {
        $this->_Booking = $Booking;  
        $this->_request = $request;  
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->_request->getParam('id');
        $postData = $this->_Booking->create();
        $result = $postData->setId($id);
        $result = $result->delete();
        $this->messageManager->addSuccessMessage('Booking Deleted done !');  
   
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('customer/index/bookinglist');
        return $resultRedirect;
    }
}
