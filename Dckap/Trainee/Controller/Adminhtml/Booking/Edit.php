<?php
namespace Dckap\Trainee\Controller\Adminhtml\Booking;

use Dckap\Trainee\Model\BookingFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
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
    private $coreRegistry;

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
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->_Booking->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getEntityId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('grid/grid/rowdata');
                return;
            }
        }

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Row Data ') . $rowTitle : __('Add Row Data');
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
