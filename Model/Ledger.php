<?php
namespace Eckohaus\IpLedger\Model;

use Magento\Framework\Model\AbstractModel;

class Ledger extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Eckohaus\IpLedger\Model\ResourceModel\Ledger::class);
    }
}
