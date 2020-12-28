<?php

namespace Albedo\NewsletterApi\Api\Data;

use Magento\Cms\Api\Data\PageSearchResultsInterface;

interface SubscribersSearchResultsInterface {

    /**
     * Get subscribers list.
     *
     * @return \Albedo\NewsletterApi\Api\Data\SubscriberInterface[]
     */
    public function getItems();

    /**
     * Set subscribers list.
     *
     * @param \Albedo\NewsletterApi\Api\Data\SubscriberInterface[] $subscribers
     * @return $this
     */
    public function setItems(array $subscribers);
}