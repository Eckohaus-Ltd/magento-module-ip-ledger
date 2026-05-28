<?php
namespace Eckohaus\IpLedger\Block\Index;

use Magento\Framework\View\Element\Template;
use Eckohaus\IpLedger\Model\ResourceModel\Ledger\CollectionFactory;

class Ledger extends Template
{
    protected $collectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getActiveCases()
    {
        $collection = $this->collectionFactory->create();
        
        // Optional: Filter to only show OPEN cases in the active queue
        $collection->addFieldToFilter('status', 'Open');

        $cases = [];
        foreach ($collection as $item) {
            // Mapping frontend expected keys to actual database columns
            $cases[] = [
                'case_number' => $item->getData('case_number'), 
                'date'        => $item->getData('date_opened'),        
                'title'       => $item->getData('title_of_work'),
                'status'      => strtoupper($item->getData('status')),
                'agency'      => $item->getData('jurisdiction'),
                'format'      => $item->getData('type_of_work')
            ];
        }

        return $cases;
    }
}
