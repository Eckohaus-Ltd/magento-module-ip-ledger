<?php
namespace Eckohaus\IpLedger\Controller\Adminhtml\Ledger;

use Magento\Backend\App\Action;
use Eckohaus\IpLedger\Model\LedgerFactory;

class Save extends Action
{
    protected $ledgerFactory;

    public function __construct(Action\Context $context, LedgerFactory $ledgerFactory)
    {
        $this->ledgerFactory = $ledgerFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $model = $this->ledgerFactory->create();
            $model->setData($data)->save();
            $this->messageManager->addSuccessMessage(__('Case saved successfully.'));
        }
        return $this->_redirect('*/*/');
    }

    protected function _isAllowed() { return $this->_authorization->isAllowed('Eckohaus_IpLedger::ledger'); }
}
