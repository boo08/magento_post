<?php


namespace Dckap\Trainee\Controller\Adminhtml\Booking;

use Dckap\Trainee\Model\BookingFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Add extends Action
{

    /**
     * @var PageFactory
     */
    protected $Booking;
    protected $pageFactory;
    protected $context;

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
        $this->pageFactory = $pageFactory;
        $this->Booking = $Booking;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return Page
     */
    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Dckap_Trainee::booking_menu');
        $title = __('Add Booking');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dckap_Trainee::add');
    }
}
