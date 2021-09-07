<?php
namespace Dckap\Trainee\Helper;
class Data
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Recipient email config path
     */
    const XML_PATH_DCKAP = 'dckap/trainee/enable';

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Sample function returning config value
     **/

    public function getGeneralConfig() {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

        return $this->scopeConfig->getValue(self::XML_PATH_DCKAP);


    }


}
