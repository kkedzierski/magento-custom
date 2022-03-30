<?php

namespace Custom\SampleModule\Block;

use Custom\SampleModule\Model\Item;
use Magento\Framework\View\Element\Template;
use Custom\SampleModule\Model\ResourceModel\Item\Collection;
use Custom\SampleModule\Model\ResourceModel\Item\CollectionFactory;

class Hello extends Template
{

    private CollectionFactory $collectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    )
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->collectionFactory->create()->getItems();
    }
}
