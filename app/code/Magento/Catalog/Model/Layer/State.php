<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Catalog\Model\Layer;

use Magento\Catalog\Model\Layer\Filter\Item;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Object;

/**
 * Layered navigation state model
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class State extends Object
{
    /**
     * Add filter item to layer state
     *
     * @param   Item $filter
     * @return  $this
     */
    public function addFilter($filter)
    {
        $filters = $this->getFilters();
        $filters[] = $filter;
        $this->setFilters($filters);
        return $this;
    }

    /**
     * Set layer state filter items
     *
     * @param  Item[] $filters
     * @return $this
     * @throws LocalizedException
     */
    public function setFilters($filters)
    {
        if (!is_array($filters)) {
            throw new LocalizedException(__('The filters must be an array.'));
        }
        $this->setData('filters', $filters);
        return $this;
    }

    /**
     * Get applied to layer filter items
     *
     * @return Item[]
     */
    public function getFilters()
    {
        $filters = $this->getData('filters');
        if (is_null($filters)) {
            $filters = [];
            $this->setData('filters', $filters);
        }
        return $filters;
    }
}
