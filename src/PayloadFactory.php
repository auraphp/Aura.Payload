<?php
namespace Aura\Payload;

class PayloadFactory
{

    /**
     * Create a new Payload
     *
     * @return Aura\Payload_Interface\PayloadInterface
     *
     * @access public
     */
    public function newInstance()
    {
        return new Payload();
    }
}
