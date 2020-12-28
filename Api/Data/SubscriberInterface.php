<?php

namespace Albedo\NewsletterApi\Api\Data;

interface SubscriberInterface {

    /**
     * @param $subscriberId
     * @return mixed
     */
    public function setSubscriberId($subscriberId);

    /**
     * @return mixed
     */
    public function getSubscriberId();

    /**
     * @return mixed
     */
    public function getStoreId();

    /**
     * @param $storeId
     * @return mixed
     */
    public function setStoreId($storeId);

    /**
     * @param $email
     * @return mixed
     */
    public function setSubscriberEmail($email);

    /**
     * @return mixed
     */
    public function getSubscriberEmail();

    /**
     * @return mixed
     */
    public function getChangeStatusAt();

    /**
     * @param $datetime
     * @return mixed
     */
    public function setChangeStatusAt($datetime);

    /**
     * @return int|mixed
     */
    public function getSubscriberStatus();

    /**
     * @param $status
     * @return mixed
     */
    public function setSubscriberStatus($status);

    /**
     * @return mixed
     */
    public function getSubscriberConfirmCode();

    /**
     * @param $confirmCode
     * @return mixed
     */
    public function setSubscriberConfirmCode($confirmCode);

}