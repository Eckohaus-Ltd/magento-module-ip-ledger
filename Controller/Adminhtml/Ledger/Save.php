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
            // 1. Flatten the array in case Knockout JS nested the data inside the 'general' fieldset
            if (isset($data['general']) && is_array($data['general'])) {
                $data = array_merge($data, $data['general']);
            }

            // 2. Strip empty primary keys so MySQL auto-increment can do its job safely
            if (empty($data['entity_id'])) {
                unset($data['entity_id']);
            }

            $model = $this->ledgerFactory->create();

            // If we are editing an existing case, load it into memory first
            if (!empty($data['entity_id'])) {
                $model->load($data['entity_id']);
            }

            $model->setData($data);

            // 3. The Catch Block: Print any database errors directly to the UI
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('Case locked into the ledger successfully.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Database Error: %1', $e->getMessage()));
                // Send them back to the form so they don't lose their typed data
                return $this->_redirect('*/*/newAction'); 
            }
        }
        
        return $this->_redirect('*/*/');
    }

    protected function _isAllowed() { return $this->_authorization->isAllowed('Eckohaus_IpLedger::ledger'); }
}
