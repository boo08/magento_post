<?php
namespace Dckap\Trainee\Controller\Adminhtml\Booking;

use Dckap\Trainee\Model\BookingFactory;
use Dckap\Trainee\Model\ResourceModel\Booking;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class MassDelete extends Action
{

    /**
     * @var BookingFactory
     */
    private $_BookingFactory;
    /**
     * @var Booking
     */
    private $_Booking;

    /**
     * @param Context $context
     * @param BookingFactory $BookingFactory
     * @param Booking $Booking
     */
    public function __construct(
        Context $context,
        BookingFactory $BookingFactory,
        Booking $Booking
    ) {
        $this->_BookingFactory = $BookingFactory;
        $this->_Booking = $Booking;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $selectedIds = $data['selected'];
        try {
            foreach ($selectedIds as $selectedId) {
                $deleteData = $this->_BookingFactory->create();
                $deleteData->load($selectedId);
                $deleteData->delete();
            }
            $this->messageManager->addSuccessMessage(__('Row data has been successfully deleted.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }

        $this->_redirect('booking/booking/show');
    }

    /**
     * Check Category Map recode delete Permission.
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dckap_Trainee::massdelete');
    }
}
