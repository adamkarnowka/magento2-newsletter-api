<?php

namespace Albedo\NewsletterApi\Model;

use Magento\Framework\Exception\LocalizedException;

class SubscriberManagement extends \Magento\Newsletter\Model\Subscriber implements \Albedo\NewsletterApi\Api\SubscriberManagementInterface
{

    protected $subscriberModel;

    protected $subscribersCollection;
    protected $emailValidator;

    protected $collectionProcessor;

    public function __construct(
        \Magento\Newsletter\Model\Subscriber $subscriberModel,
        \Magento\Newsletter\Model\ResourceModel\Subscriber\Collection $subscribersCollection,
        \Magento\Framework\Validator\EmailAddress $emailValidator,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->subscriberModel = $subscriberModel;
        $this->subscribersCollection = $subscribersCollection;
        $this->emailValidator = $emailValidator;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param \Albedo\NewsletterApi\Api\Data\SubscriberInterface $subscriber
     * @return \Albedo\NewsletterApi\Api\Data\SubscriberInterface
     * @throws LocalizedException
     */
    public function postSubscriber($subscriber)
    {
        $email = (string)$subscriber->getSubscriberEmail();

        $this->validateEmailFormat($email);

        $subscriberModel = $this->subscriberModel->loadByEmail($email);
        if ($subscriberModel->getId()
            && (int) $subscriberModel->getSubscriberStatus() === \Magento\Newsletter\Model\Subscriber::STATUS_SUBSCRIBED
        ) {
            throw new LocalizedException(
                __('This email address is already subscribed.')
            );
        }

        $status = (int) $subscriberModel->subscribe($email);

        $subscriber->addData($subscriberModel->getData());
        return $subscriber;

    }

    /**
     * Validates the format of the email address
     *
     * @param string $email
     * @throws LocalizedException
     * @return void
     */
    protected function validateEmailFormat($email)
    {
        if (!$this->emailValidator->isValid($email)) {
            throw new LocalizedException(__('Please enter a valid email address.'));
        }
    }

    public function postConfirm($id, $confirmCode){
        $subscriber = $this->subscriberModel->load($id);

        if ($subscriber->getId() && $subscriber->getCode()) {
            if ($subscriber->confirm($confirmCode)) {
                return $subscriber;
            } else {
                throw new \Exception(__('This is an invalid subscription confirmation code.'));
            }
        } else {
           throw new \Exception(__('This is an invalid subscription ID.'));
        }
    }

    public function postUnsubscribe($id, $confirmCode){
        $subscriber = $this->subscriberModel->load($id);
        $subscriber->setCheckCode($confirmCode);
        $subscriber->unsubscribe();

        return $subscriber;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Newsletter\Model\ResourceModel\Subscriber\Collection
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria){

        $collection = $this->subscribersCollection;

        $this->collectionProcessor->process($searchCriteria, $collection);
        $collection->load();

        return $collection;
    }

}

