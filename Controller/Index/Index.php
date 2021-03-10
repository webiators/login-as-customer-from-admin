<?php
/**
 * @category   Webiators
 * @package    Webiators_LoginAsCustomerFromAdmin
 * @author     Webiators Team
 * @copyright  Copyright (c) Webiators Technologies Private Limited. ( https://webiators.com ).
 */

declare(strict_types=1);

namespace Webiators\LoginAsCustomerFromAdmin\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $_customerFactory;
    protected $_sessionFactory;
    protected $_accountRedirect;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\SessionFactory $sessionFactory,
        \Magento\Customer\Model\Account\Redirect $accountRedirect
    ) {
        $this->_customerFactory = $customerFactory;
        $this->_sessionFactory = $sessionFactory;
        $this->_accountRedirect = $accountRedirect;
        parent::__construct($context);
    }

    /**
     *
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $customerID   = $this->getRequest()->getParam('customer_id');
        $customer = $this->_customerFactory->create()->load($customerID);
        $customerSession = $this->_sessionFactory->create();
        $customerSession->setCustomerAsLoggedIn($customer);
        $redirectUrl = $this->_accountRedirect->getRedirectCookie();
        if($customerSession->isLoggedIn()) {
            $this->_accountRedirect->clearRedirectCookie();
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setUrl($this->_redirect->success($redirectUrl));
            return $this->_accountRedirect->getRedirect('customer/account/login');
        }
        return $this->_accountRedirect->getRedirect('customer/account/login');
    }

}

