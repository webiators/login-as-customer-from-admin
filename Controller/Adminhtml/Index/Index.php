<?php
/**
 * @category   Webiators
 * @package    Webiators_LoginAsCustomerFromAdmin
 * @author     Webiators Team
 * @copyright  Copyright (c) Webiators Technologies Private Limited. ( https://webiators.com ).
 */

declare(strict_types=1);

namespace Webiators\LoginAsCustomerFromAdmin\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Url;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Store\Model\StoreManagerInterface;

class Index extends Action
{

    /**
     * @var CustomerFactory
     */
    protected $_customerFactory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager  = null;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context  $context
     */
    public function __construct(
        Context $context,
        CustomerFactory $customerFactory,
        StoreManagerInterface $storeManager = null
    ) {
        $this->_customerFactory = $customerFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     *s
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $customerId = $this->getRequest()->getParam('id');
        $customer   = $this->_customerFactory->create()->load($customerId);
        if (!$customer->getId()) {
            $errMsg="Sorry, Customer with this ID are no longer exist.";
            $this->messageManager->addErrorMessage(__($errMsg));
            return $this->_redirect('customer');
        }
        $loginUrl = $this->_objectManager->create(Url::class)
        ->getUrl('wtcustomerfromadmin/index/index', ['customer_id' => $customerId]);
        return $this->getResponse()->setRedirect($loginUrl);
    }
}
