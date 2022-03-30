<?php

namespace Custom\SampleModule\Cron;

use Custom\SampleModule\Model\ItemFactory;
use Custom\SampleModule\Model\Config;

class AddItem
{
    private ItemFactory $itemFactory;
    private Config $config;

    public function __construct(ItemFactory $itemFactory, Config $config)
    {
        $this->itemFactory = $itemFactory;
        $this->config = $config;
    }

    public function execute()
    {
        if( $this->config->isEnabled() ){
            $this->itemFactory->create()
                ->setName('Scheduled item')
                ->setDescription('created at '. time())
                ->save();
        }
    }

}
