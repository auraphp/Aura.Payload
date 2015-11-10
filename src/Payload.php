<?php
namespace Aura\Payload;

use Aura\Payload_Interface\PayloadInterface;

class Payload implements PayloadInterface
{
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
