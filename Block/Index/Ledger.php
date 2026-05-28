<?php
namespace Eckohaus\IpLedger\Block\Index;

use Magento\Framework\View\Element\Template;

class Ledger extends Template
{
    /**
     * Staging Data Provider based on USCO eCO Portal
     * To be replaced with Collection Factory once DB schema is finalized.
     */
    public function getActiveCases()
    {
        return [
            [
                'case_number' => '1-15166255541',
                'date' => '2026.05.22', // Formatted for OS aesthetic
                'title' => 'AMRE FORTRAN CALCULATION MOTOR',
                'status' => 'OPEN',
                'agency' => 'USCO',
                'format' => 'Literary Work'
            ],
            [
                'case_number' => '1-15162396971',
                'date' => '2026.05.13',
                'title' => 'AMRE ARCADE TERMINAL: BASE EQUATION DATA STRUCTURE',
                'status' => 'OPEN',
                'agency' => 'USCO',
                'format' => 'Literary Work'
            ]
        ];
    }
}

