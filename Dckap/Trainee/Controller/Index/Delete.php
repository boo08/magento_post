<?php
namespace Dckap\Trainee\Controller\Index;

use Dckap\Trainee\Model\BookingFactory;
use Dckap\Trainee\Model\ResourceModel\Booking;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Delete extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;
    protected $_Booking;
    protected $_request;

    /**
     * @var BookingFactory
     */
    private $_BookingFactory;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param BookingFactory $BookingFactory
     * @param Booking $Booking
     * @param Http $request
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        BookingFactory $BookingFactory,
        Booking $Booking,
        Http $request
    ) {
        $this->_BookingFactory = $BookingFactory;
        $this->_Booking = $Booking;
        $this->_request = $request;
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    /**
     * View page action
     *
     * @return ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $id = $this->_request->getParam('id');
        $postData = $this->_BookingFactory->create();
        $postData->load($id);
        $postData->delete();
        $this->messageManager->addSuccessMessage('Booking Deleted done !');

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('booking/index/show');
        return $resultRedirect;
    }
}
