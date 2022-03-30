<?php

namespace Custom\SampleModule\Model;

use Custom\SampleModule\Api\Data\ItemInterface;
use Custom\SampleModule\Api\ItemRepositoryInterface;
use Custom\SampleModule\Model\ResourceModel\Item\CollectionFactory;
class ItemRepository implements ItemRepositoryInterface
{

    private CollectionFactory $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function getList(): array
    {
        return $this->collectionFactory->create()->getItems();
    }
}
