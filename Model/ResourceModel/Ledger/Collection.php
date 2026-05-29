<?php
namespace Eckohaus\IpLedger\Model\ResourceModel\Ledger;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(
            \Eckohaus\IpLedger\Model\Ledger::class,
            \Eckohaus\IpLedger\Model\ResourceModel\Ledger::class
        );
    }
}
