<?php
namespace Aura\Payload;

use Aura\Payload_Interface\PayloadInterface;

class Payload implements PayloadInterface
{
    const ACCEPTED = 'ACCEPTED';
    const AUTHENTICATED = 'AUTHENTICATED';
    const AUTHORIZED = 'AUTHORIZED';
    const CREATED = 'CREATED';
    const DELETED = 'DELETED';
    const ERROR = 'ERROR';
    const FAILURE = 'FAILURE';
    const FOUND = 'FOUND';
    const NOT_ACCEPTED = 'NOT_ACCEPTED';
    const NOT_AUTHENTICATED = 'NOT_AUTHENTICATED';
    const NOT_AUTHORIZED = 'NOT_AUTHORIZED';
    const NOT_CREATED = 'NOT_CREATED';
    const NOT_DELETED = 'NOT_DELETED';
    const NOT_FOUND = 'NOT_FOUND';
    const NOT_UPDATED = 'NOT_UPDATED';
    const NOT_VALID = 'NOT_VALID';
    const PROCESSING = 'PROCESSING';
    const SUCCESS = 'SUCCESS';
    const UPDATED = 'UPDATED';
    const VALID = 'VALID';

    protected $status;
    protected $input;
    protected $output;
    protected $messages;
    protected $extras;

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setInput($input)
    {
        $this->input = $input;
        return $this;
    }

    public function getInput()
    {
        return $this->input;
    }

    public function setOutput($output)
    {
        $this->output = $output;
        return $this;
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function setMessages($messages)
    {
        $this->messages = $messages;
        return $this;
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function setExtras($extras)
    {
        $this->extras = $extras;
        return $this;
    }

    public function getExtras()
    {
        return $this->extras;
    }
}
