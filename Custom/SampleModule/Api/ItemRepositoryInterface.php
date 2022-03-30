<?php

namespace Custom\SampleModule\Api;

use Custom\SampleModule\Api\Data\ItemInterface;

interface ItemRepositoryInterface
{

    /**
     * @return ItemInterface[]
     */
    public function getList(): array;
}
