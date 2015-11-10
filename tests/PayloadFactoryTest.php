<?php
namespace Aura\Payload;

class PayloadFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $payloadFactory = new PayloadFactory();
        $payload = $payloadFactory->newInstance();
        $this->assertInstanceOf('Aura\Payload\Payload', $payload);
    }
}
