<?php
/**
 * Copyright © Albedo All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Albedo\NewsletterApi\Api;

interface SubscriberManagementInterface
{

    /**
     * POST for Subscriber api
     * @param \Albedo\NewsletterApi\Api\Data\SubscriberInterface $subscriber
     * @return \Albedo\NewsletterApi\Api\Data\SubscriberInterface
     */
    public function postSubscriber($subscriber);

    /**
     * @param int $id
     * @param string $confirmationCode
     * @return \Albedo\NewsletterApi\Api\Data\SubscriberInterface
     */
    public function postUnsubscribe($id,$confirmationCode);

    /**
     * @param int $id
     * @param string $confirmationCode
     * @return \Albedo\NewsletterApi\Api\Data\SubscriberInterface
     */
    public function postConfirm($id,$confirmationCode);

    /**
     * Retrieve pages matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Albedo\NewsletterApi\Api\Data\SubscribersSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}


