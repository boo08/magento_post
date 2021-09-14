<?php

namespace Dckap\Trainee\Observer;

use Magento\Framework\Registry;

class ChangeProductName implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var Registry
     */
    protected $_registry;

    public function __construct(
        Registry $registry
    ) {
        $this->_registry = $registry;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $product = $observer->getProduct();
        $product->setName($product->getName() . " this is product");
        return $this;
    }
}
