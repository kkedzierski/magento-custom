<?php

namespace Custom\SampleModule\Model;

use Magento\Framework\Model\AbstractModel;

class Item extends AbstractModel
{
    protected function __construct()
    {
        $this->_init(\Custom\SampleModule\Model\ResourceModel\Item::class);
    }
}
