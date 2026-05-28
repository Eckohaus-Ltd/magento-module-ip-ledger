<?php
namespace Eckohaus\IpLedger\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    protected $resultPageFactory;

    public function __construct(PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        // This sets the browser tab and page title
        $resultPage->getConfig()->getTitle()->set('USCO & DGIP Active Ledger');
        return $resultPage;
    }
}
