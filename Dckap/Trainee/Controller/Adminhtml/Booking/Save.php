<?php

namespace Dckap\Trainee\Controller\Adminhtml\Booking;

use Dckap\Trainee\Model\BookingFactory;
use Dckap\Trainee\Model\ResourceModel\Booking;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Save extends Action
{
    /**
     * @var BookingFactory
     */
    public $bookingFactory;
    /**
     * @var Booking
     */
    private $booking;

    /**
     * @param Context $context
     * @param BookingFactory $bookingFactory
     * @param Booking $booking
     */
    public function __construct(
        Context $context,
        BookingFactory $bookingFactory,
        Booking $booking
    ) {
        parent::__construct($context);
        $this->bookingFactory = $bookingFactory;
        $this->booking = $booking;
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
            $this->booking->save($rowData);
            $this->messageManager->addSuccessMessage(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $this->_redirect('booking/booking/show');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dckap_Trainee::save');
    }
}
