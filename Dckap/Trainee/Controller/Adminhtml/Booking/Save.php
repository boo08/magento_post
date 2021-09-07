<?php

namespace Dckap\Trainee\Controller\Adminhtml\Booking;

use Dckap\Trainee\Model\BookingFactory;
use Magento\Backend\App\Action\Context;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var BookingFactory
     */
    public $bookingFactory;

    /**
     * @param Context $context
     * @param BookingFactory $bookingFactory
     */
    public function __construct(
        Context $context,
        BookingFactory $bookingFactory
    ) {
        parent::__construct($context);
        $this->bookingFactory = $bookingFactory;
    }


    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('booking/booking/add');
            return;
        }
        try {
            $rowData = $this->bookingFactory->create();
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setEntityId($data['id']);
            }
            $rowData->save();
            $this->messageManager->addSuccessMessage(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $this->_redirect('grid/grid/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dckap_Trainee::save');
    }
}
