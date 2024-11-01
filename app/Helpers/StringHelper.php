<?php

namespace App\Helpers;

use NumberFormatter;

class StringHelper
{
    public function formatCurrency($amount)
    {
        $formatter = new NumberFormatter('vi_VN', NumberFormatter::CURRENCY);
        $formattedAmount = $formatter->formatCurrency($amount, 'VND');

        return $formattedAmount;
    }
}
