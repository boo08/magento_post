<?php
namespace Dckap\Trainee\Block\Adminhtml;

use Dckap\Trainee\Helper\Data;
use Magento\Framework\View\Element\Template\Context;

class Booking extends \Magento\Framework\View\Element\Template
{
    protected $helperData;

    /**
     * @param Context $context
     * @param Data $helperData
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $helperData,
        array $data = []
    ) {
        $this->helperData = $helperData;
        parent::__construct($context, $data);
    }

    /**
     * Get form action URL for POST booking request
     *
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('booking/index/save', ['_secure' => true]);
    }

}
