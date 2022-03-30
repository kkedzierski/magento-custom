<?php

namespace Custom\SampleModule\Model;

use Custom\SampleModule\Model\ResourceModel\Item as ItemModel;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;

class Item extends AbstractModel
{
    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = [])
    {
        $this->_init(ItemModel::class);
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

}
