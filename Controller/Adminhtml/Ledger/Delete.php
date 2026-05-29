<?php
namespace Eckohaus\IpLedger\Controller\Adminhtml\Ledger;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Eckohaus\IpLedger\Model\LedgerFactory;

class Delete extends Action
{
    protected $ledgerFactory;

    public function __construct(
        Context $context,
        LedgerFactory $ledgerFactory
    ) {
        parent::__construct($context);
        $this->ledgerFactory = $ledgerFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            try {
                $model = $this->ledgerFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('The IP Ledger record has been deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}
