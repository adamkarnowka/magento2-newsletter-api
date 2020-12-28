<?php

namespace Albedo\NewsletterApi\Model;

class Subscriber implements \Albedo\NewsletterApi\Api\Data\SubscriberInterface{

    private $data = [];

    /**
     * @param string $email
     * @return \Magento\Newsletter\Model\Subscriber|void
     */
    public function setSubscriberEmail($email){
        $this->setData('subscriber_email', $email);
    }

    /**
     * @return mixed|string
     */
    public function getSubscriberEmail(){
        return $this->getData('subscriber_email');
    }

    /**
     * @return int|mixed
     */
    public function getStoreId(){
        return $this->getData('store_id');
    }

    /**
     * @param int $storeId
     * @return \Magento\Newsletter\Model\Subscriber|void
     */
    public function setStoreId($storeId){
        $this->setData('store_id', $storeId);
    }

    /**
     * @param int $subscriberId
     * @return \Magento\Newsletter\Model\Subscriber|void
     */
    public function setSubscriberId($subscriberId){
        $this->setData('subscriber_id', $subscriberId);
    }

    /**
     * @return int
     */
    public function getSubscriberId(){
        return $this->getData('subscriber_id');
    }

    /**
     * @param int $status
     * @return \Magento\Newsletter\Model\Subscriber|void
     */
    public function setSubscriberStatus($status)
    {
        $this->setData('subscriber_status', $status);
    }

    /**
     * @return int|mixed
     */
    public function getSubscriberStatus()
    {
        return $this->getData('subscriber_status');
    }

    /**
     * @return mixed|string
     */
    public function getChangeStatusAt(){
        return $this->getData('change_status_at');
    }

    /**
     * @param string $datetime
     * @return \Magento\Newsletter\Model\Subscriber|void
     */
    public function setChangeStatusAt($datetime){
        $this->setData('change_status_at', $datetime);
    }

    /**
     * @return mixed|string
     */
    public function getSubscriberConfirmCode(){
        return $this->getData('subscriber_confirm_code');
    }

    /**
     * @param string $confirmCode
     * @return \Magento\Newsletter\Model\Subscriber|void
     */
    public function setSubscriberConfirmCode($confirmCode)
    {
        $this->setData('subscriber_confirm_code', $confirmCode);
    }

    private function setData($key, $value){
        $this->data[$key] = $value;
    }


    private function getData($key){
        return $this->data[$key];
    }

    public function addData($data){
        $this->data = $data;
    }
}