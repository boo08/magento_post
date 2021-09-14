<?php
namespace Dckap\StatesControl\Helper;

use Magento\Directory\Model\ResourceModel\Region\Collection  as RegionCollection;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var RegionCollection
     */
    private $regionCollection;

    public function __construct(ScopeConfigInterface $scopeConfig, RegionCollection $regionCollection)
    {
        $this->regionCollection = $regionCollection;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Sample function returning config value
     * @param $configKey
     * @return mixed
     */

    public function getConfig($configKey)
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

        return $this->scopeConfig->getValue($configKey);
    }

    public function getShippingExcludeStates()
    {
        $excludeStatesName=[];
        $excludeStates= $this->getConfig('dckap_state/control/us_state_filter');
        foreach (explode(",", $excludeStates) as $states) {
            $region = $this->regionCollection->getItemById($states);
            $excludeStatesName[]=$region->getName();
        }

        return implode(",", $excludeStatesName);
    }
}
