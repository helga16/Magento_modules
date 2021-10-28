<?php

namespace Nvg\Popup\UI\Component\Form;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class StatusOptions
 * @package Nvg\Popup\UI\Component\Form
 */
class StatusOptions implements OptionSourceInterface
{
    private const STATUS_MAP = [
      0 => 'New',
      1 => 'In progress',
      2 => 'Closed'
    ];

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        $currentOptions = [];

        foreach (self::STATUS_MAP as $item=>$val) {
            $currentOptions[$item]['label'] = $val;
            $currentOptions[$item]['value'] = $item;
        }
        return array_values($currentOptions);
    }
}