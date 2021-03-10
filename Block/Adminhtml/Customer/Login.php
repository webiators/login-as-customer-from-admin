<?php
/**
 * @category   Webiators
 * @package    Webiators_LoginAsCustomerFromAdmin
 * @author     Webiators Team
 * @copyright  Copyright (c) Webiators Technologies Private Limited. ( https://webiators.com ).
 */

namespace Webiators\LoginAsCustomerFromAdmin\Block\Adminhtml\Customer;

use Webiators\LoginAsCustomerFromAdmin\Helper\Data;
use Magento\Backend\Block\Widget\Context;
use Magento\Customer\Block\Adminhtml\Edit\GenericButton;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 *
 * @package Webiators\LoginAsCustomerFromAdmin\Block\Adminhtml\Customer
 */
class Login extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var Data
     */
    protected $_helper;
    /**
     * 
     *
     * @param Context $context
     * @param Registry $registry
     * @param Data $helper
     */
    public function __construct(
        Context $context,
        Data $helper,
        Registry $registry
    ) {
        $this->_helper = $helper;
        parent::__construct($context, $registry);
    }

    public function getButtonData()
    {
        $custId = $this->getCustomerId();
        $data = [];
        if ($this->_helper->isLoginAsCustomerEnabled() && $custId) {
            $data = [
                'label'      => __('Login as Customer'),
                'class'      => 'login-as-customer-by-webiators',
                'on_click'   => sprintf("window.open('%s');", $this->getVerificationUrl()),
                'sort_order' => 60,
            ];
        }

        return $data;
    }

    public function getVerificationUrl()
    {
        return $this->getUrl('wtcustomerfromadmin/index/index', ['id' => $this->getCustomerId()]);
    }
}
