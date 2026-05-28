<?php
namespace Eckohaus\IpLedger\Controller\Adminhtml\Ledger;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Eckohaus_IpLedger::ledger');
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Eckohaus_IpLedger::ledger');
        $resultPage->getConfig()->getTitle()->prepend(__('Add/Edit Ledger Case'));
        return $resultPage;
    }
}
