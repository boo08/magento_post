<?php

namespace Dckap\Trainee\Block\Adminhtml\Booking;
use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Phrase;
use Magento\Framework\Registry;

/**
 * Class Edit
 * @package Dckap\Trainee\Block\Adminhtml\Booking
 */
class Edit extends Container
{
    /**
     * Core registry.
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(Context $context, Registry $registry, array $data = [])
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     *
     */
    protected function _construct()
    {
        $this->_objectId = 'entity_id';
        $this->_blockGroup = 'Dckap_Trainee';
        $this->_controller = 'adminhtml_booking';
        parent::_construct();
        if ($this->_isAllowedAction('Dckap_Trainee::edit')) {
            $this->buttonList->update('back', 'onclick', "setLocation('" . $this->getUrl('*/*/show') . "')");
            $this->buttonList->update('save', 'label', __('Save'));
        } else {
            $this->buttonList->update('back', 'onclick', "setLocation('" . $this->getUrl('*/*/show') . "')");
            $this->buttonList->remove('save');
        }
        $this->buttonList->remove('reset');
    }

    /**
     * Retrieve text for header element depending on loaded image.
     *
     * @return Phrase
     */
    public function getHeaderText()
    {
        return __('Edit Booking');
    }

    /**
     * Check permission for passed action.
     *
     * @param string $resourceId
     *
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Get form action URL.
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }
        return $this->getUrl('*/*/save');
    }
}
