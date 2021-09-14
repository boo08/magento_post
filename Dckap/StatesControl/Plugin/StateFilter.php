<?php

namespace Dckap\StatesControl\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Psr\Log\LoggerInterface;

class StateFilter
{

    /**

     * @var ScopeConfigInterface

     */

    protected $scopeConfig;

    protected $excludeUsStates;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * StateFilter constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param LoggerInterface $logger
     */

    public function __construct(ScopeConfigInterface $scopeConfig, LoggerInterface $logger)
    {
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger;
    }

    public function afterToOptionArray($subject, $options)
    {
        $checkEnable = $this->scopeConfig->getValue('dckap_state/control/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
//        $this->logger->critical('filters : ' . $checkEnable);
        if ($checkEnable) {
            $excludeStates  = $this->scopeConfig->getValue('dckap_state/control/us_state_filter', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            $this->excludeUsStates = explode(",", $excludeStates);
            $result = array_filter($options, function ($option) {
                if (isset($option['value'])) {
                    return !in_array($option['value'], $this->excludeUsStates);
                }
                return true;
            });
            return $result;
        }
        return $options;

    }
}
