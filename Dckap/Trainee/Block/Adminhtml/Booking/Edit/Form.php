<?php

namespace Dckap\Trainee\Block\Adminhtml\Booking\Edit;

use Dckap\Trainee\Model\BookingFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;

/**
 * Class Form
 * @package Dckap\Trainee\Block\Adminhtml\Booking\Edit
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var
     */
    protected $_systemStore;

    /**
     * @var Config
     */
    private $_wysiwygConfig;
    /**
     * @var BookingFactory
     */
    private $_Booking;

    /**
     * Form constructor.
     * @param Context $context
     * @param Registry $registry
     * @param BookingFactory $BookingFactory
     * @param FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        BookingFactory $BookingFactory,
        FormFactory $formFactory,
        array $data = []
    ) {
        $this->_Booking = $BookingFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return Form
     * @throws LocalizedException
     */
    protected function _prepareForm()
    {
        $model='';
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->_Booking->create();
        /** @var Page $resultPage */

        $form = $this->_formFactory->create(['data' => ['id' => 'edit_form', 'enctype' => 'multipart/form-data', 'action' => $this->getData('action'), 'method' => 'post','data-mage-init'=>'{"validation":{"rules": {"firstname": {required:true,\'minlength\':5,\'maxlength\':15}}}}']]);
        $form->setHtmlIdPrefix('dckap_trainee');
        if ($rowId) {
            $model = $rowData->load($rowId);
            $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Booking Details'), 'class' => 'fieldset-wide']);
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        } else {
            $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Booking Details'), 'class' => 'fieldset-wide']);
        }
        $fieldset->addField(
            'firstname',
            'text',
            [
                'name' => 'firstname',
                'label' => __('First Name'),
                'title' => __('First Name'),
                'class' => 'required-entry max_text_length',
                'minlength'=>5,
                'maxlength'=>15,
                'required' => true,
            ]
        );

        $fieldset->addField(
            'lastname',
            'text',
            [
                'name' => 'lastname',
                'label' => __('Last Name'),
                'title' => __('Last Name'),
                'class' => 'required-entry max_text_length ',
                'minlength'=>5,
                'maxlength'=>15,
                'required' => true,
            ]
        );
        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'title' => __('Email'),
                'class' => 'required-entry validate-email',
                'required' => true,
                'disabled' => $model ? true : false,
            ]
        );
        $fieldset->addField(
            'telephone',
            'text',
            [
                'name' => 'telephone',
                'label' => __('Phone'),
                'title' => __('Phone'),
                'class' => 'required-entry validate-phoneStrict',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'dob',
            'date',
            [
                'name' => 'dob',
                'label' => __('DOB'),
                'title' => __('Dob'),
                'date_format' => 'yyyy-MM-dd',
                'class' => 'required-entry validate-date validate-dob',
                'required' => true
            ]
        );

        $form->setValues($model ? $model->getData() : '');
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
