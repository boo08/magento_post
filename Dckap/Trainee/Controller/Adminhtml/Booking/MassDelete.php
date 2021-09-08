<?php
namespace Dckap\Trainee\Controller\Adminhtml\Booking;

use Dckap\Trainee\Model\BookingFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class MassDelete extends Action
{

    /**
     * @var BookingFactory
     */
    private $_BookingFactory;

    /**
     * @param Context $context
     * @param BookingFactory $BookingFactory
     */
    public function __construct(
        Context $context,
        BookingFactory $BookingFactory
    ) {
        $this->_BookingFactory = $BookingFactory;
        parent::__construct($context);
    }


    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $selectedIds = $data['selected'];
        try {
            foreach ($selectedIds as $selectedId) {
                $deleteData = $this->_BookingFactory->create()->load($selectedId);
                $deleteData->delete();
            }
            $this->messageManager->addSuccess(__('Row data has been successfully deleted.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
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
