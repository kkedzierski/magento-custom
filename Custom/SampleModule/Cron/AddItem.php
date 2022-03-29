<?php

namespace Custom\SampleModule\Cron;

use Custom\SampleModule\Model\ItemFactory;

class AddItem
{
    private ItemFactory $itemFactory;

    public function __construct(ItemFactory $itemFactory)
    {
        $this->itemFactory = $itemFactory;
    }

    public function execute()
    {
        $this->itemFactory->create()
            ->setName('Scheduled item')
            ->setDescription('created at '. time())
            ->save();
    }

}
