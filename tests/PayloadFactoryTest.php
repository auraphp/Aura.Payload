<?php
namespace Aura\Payload;

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class PayloadFactoryTest extends TestCase
{
    public function test()
    {
        $payloadFactory = new PayloadFactory();
        $payload = $payloadFactory->newInstance();
        $this->assertInstanceOf('Aura\Payload\Payload', $payload);
    }
}
