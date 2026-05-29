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
        
        // Push the newest cases to the top of the UI
        $collection->setOrder('date_opened', 'DESC');

        // Note: I have disabled the "Open" filter for right now so we can test it safely. 
        // Once we know it works, you can remove the '//' below to turn the filter back on!
        // $collection->addFieldToFilter('status', 'Open');

        $formattedCases = [];

        foreach ($collection as $item) {
            $formattedCases[] = [
                'case_number' => $item->getData('case_number') ?? 'PENDING',
                'date'        => $item->getData('date_opened') ?? 'N/A',
                'agency'      => strtoupper($item->getData('jurisdiction') ?? 'USCO'), 
                'title'       => $item->getData('title_of_work') ?? 'Untitled',
                'status'      => strtoupper($item->getData('status') ?? 'Processing'),
                'format'      => strtoupper($item->getData('type_of_work') ?? 'Digital Asset')
            ];
        }

        return $formattedCases;
    }
}
