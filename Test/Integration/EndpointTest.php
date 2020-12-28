<?php

declare(strict_types=1);

namespace Albedo\NewsletterApi\Test\Integration;

use Magento\Framework\Webapi\Rest\Request;
use Magento\TestFramework\TestCase\WebapiAbstract;
use Magento\TestFramework\Assert\AssertArrayContains;
use Magento\TestFramework\Helper\Bootstrap;

class EndpointTest extends \Magento\TestFramework\TestCase\WebapiAbstract
{

    const RESOURCE_PATH = '/V1/subscribers?searchCriteria=';
    const RESOURCE_PATH_SUBSCRIBE = '/V1/subscriber';
    const RESOURCE_PATH_UNSUBSCRIBE = '/V1/subscriber/:id/unsubscribe';
    const RESOURCE_PATH_CONFIRM = '/V1/subscriber/:id/confirm';

    protected function setUp()
    {
        parent::setUp();
    }

    public function testItSubscribesCorrectly(){
        $email = $this->getRandomEmail();
        $request = [
            'subscriber' => [
                'subscriber_email' => $email
            ]
        ];

        $serviceInfo = [
            'rest' => [
                'resourcePath' => self::RESOURCE_PATH_SUBSCRIBE,
                'httpMethod' => Request::HTTP_METHOD_POST,
            ]
        ];

        $result = $this->_webApiCall($serviceInfo, $request);

        $this->assertArrayHasKey('subscriber_email', $result);
        $this->assertEquals($email, $result['subscriber_email']);
        $this->assertArrayHasKey('subscriber_id', $result);
        $this->assertGreaterThan(0, $result['subscriber_id']);

        return [$result['subscriber_id'],$result['subscriber_confirm_code'], $email];
    }


    /**
     * @depends testItSubscribesCorrectly
     */
    public function testItConfirmsCorrectly($result){
        $subscriberId = $result[0];
        $confirmationCode = $result[1];
        $email  = $result[2];

        $request = [
            'confirmation_code' => $confirmationCode
        ];

        $serviceInfo = [
            'rest' => [
                'resourcePath' => str_replace(':id', $subscriberId, self::RESOURCE_PATH_CONFIRM),
                'httpMethod' => Request::HTTP_METHOD_POST,
            ]
        ];

        $result = $this->_webApiCall($serviceInfo, $request);

        $this->assertArrayHasKey('subscriber_status', $result);
        $this->assertEquals(\Magento\Newsletter\Model\Subscriber::STATUS_SUBSCRIBED, $result['subscriber_status']);

        return [$result['subscriber_id'], $result['subscriber_confirm_code']];
    }


    /**
     * @depends testItConfirmsCorrectly
     */
    public function testItUnsubscribesCorrectly($result){
        $subscriberId = $result[0];
        $confirmationCode = $result[1];
        $request = [
            'confirmation_code' => $confirmationCode
        ];

        $serviceInfo = [
            'rest' => [
                'resourcePath' => str_replace(':id', $subscriberId, self::RESOURCE_PATH_UNSUBSCRIBE),
                'httpMethod' => Request::HTTP_METHOD_POST,
            ]
        ];

        $result = $this->_webApiCall($serviceInfo, $request);
        $this->assertArrayHasKey('subscriber_status', $result);
        $this->assertEquals(3, $result['subscriber_status']);
    }

    public function testItFailsWhenTryingToAddIncorrectEmail(){
        $this->expectException(\Exception::class);
        $request = [
            'subscriber' => [
                'subscriber_email' => 'wrong.email@boom'
            ]
        ];

        $serviceInfo = [
            'rest' => [
                'resourcePath' => self::RESOURCE_PATH_SUBSCRIBE,
                'httpMethod' => Request::HTTP_METHOD_POST,
            ]
        ];

        $result = $this->_webApiCall($serviceInfo, $request);
        var_dump($result);
    }


    private function getRandomEmail(){
        return sprintf('subscriber_%s@domain.com', time());
    }

}
