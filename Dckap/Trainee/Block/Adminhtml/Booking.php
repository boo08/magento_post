<?php
namespace Dckap\Trainee\Block\Adminhtml;

class Booking extends \Magento\Framework\View\Element\Template
{
    protected $helperData;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Dckap\Trainee\Helper\Data $helperData,
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
