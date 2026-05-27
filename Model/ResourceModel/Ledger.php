<?php
namespace Eckohaus\IpLedger\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Ledger extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('eckohaus_ip_ledger', 'entity_id');
    }
}
