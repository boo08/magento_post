<?php
namespace Dckap\Trainee\Controller\Adminhtml\Booking;

use Dckap\Trainee\Model\BookingFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    /**
     * @var PageFactory
     */
    private $_pageFactory;
    /**
     * @var BookingFactory
     */
    private $_Booking;

    /**
     * @param Context $context
     * @param BookingFactory $Booking
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        BookingFactory $Booking,
        PageFactory $pageFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_Booking = $Booking;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return Page
     */
    public function execute():Page
    {
        $resultPage = $this->_pageFactory->create();
        $resultPage->setActiveMenu('Dckap_Trainee::booking_menu');
        $rowId = (int)$this->getRequest()->getParam('id');
        $rowData = '';

        if ($rowId) {
            $rowData = $this->_Booking->create()->load($rowId);
            if (!$rowData->getId()) {
                $this->messageManager->addSuccessMessage(__('row data no longer exist.'));
                $this->_redirect('booking/booking/show');
            }
        }
        $title = $rowId ? __('Edit Booking ') : __('Add Booking');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dckap_Trainee::edit');
    }
}
