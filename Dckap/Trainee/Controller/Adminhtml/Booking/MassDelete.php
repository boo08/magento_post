<?php
namespace Dckap\Trainee\Controller\Adminhtml\Booking;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Dckap\Trainee\Model\ResourceModel\Booking\Collection;

class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * Malefactions filter.​_
     * @var Filter
     */
    protected $_filter;

    /**
     * @var Collection
     */
    protected $_collectionFactory;
    /**
     * @var ResultFactory
     */
    protected $_resultFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param Collection $collectionFactory
     * @param ResultFactory $ResultFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        Collection $collectionFactory,
        ResultFactory $ResultFactory

    ) {

        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        $this->_resultFactory = $ResultFactory;
        parent::__construct($context);
    }

    /**
     * @return Redirect
     */
    public function execute()
    {
        $collection = $this->_filter->getCollection($this->_collectionFactory->create());
        $recordDeleted = 0;
        foreach ($collection->getItems() as $record) {
            $record->setId($record->getEntityId());
            $record->delete();
            $recordDeleted++;
        }
        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $recordDeleted));

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/show');
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
