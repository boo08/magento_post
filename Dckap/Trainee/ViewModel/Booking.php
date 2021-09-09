<?php
namespace Dckap\Trainee\ViewModel;

use Dckap\Trainee\Helper\Data;

class Booking implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $helperData;

    /**
     * @param Data $helperData
     */
    public function __construct(
        Data $helperData
    ) {
        $this->helperData = $helperData;
    }


    public function getModuleActive()
    {
        return  $this->helperData->getGeneralConfig();
    }
}
