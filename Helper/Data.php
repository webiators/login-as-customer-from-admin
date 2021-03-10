<?php
/**
 * @category   Webiators
 * @package    Webiators_LoginAsCustomerFromAdmin
 * @author     Webiators Team
 * @copyright  Copyright (c) Webiators Technologies Private Limited. ( https://webiators.com ).
 */

namespace Webiators\LoginAsCustomerFromAdmin\Helper;

/**
 * @package Webiators\LoginAsCustomerFromAdmin\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * Data constructor.
     *
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(\Magento\Framework\App\Helper\Context $context)
    {
        parent::__construct($context);
        $this->_scopeConfig = $context->getScopeConfig();
    }

    /**
     * Check if Webiators LoginAsCustomerFromAdmin module is enabled.
     *
     * @param null $storeId
     * @return mixed
     */
    public function isLoginAsCustomerEnabled($storeId = null)
    {
        return $this->_scopeConfig->getValue('webiator_loginascustomer/general/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
    }

}