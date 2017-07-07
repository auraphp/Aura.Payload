<?php

namespace Aura\Payload;

class ClassNotCloneableFixture
{
    private function __clone()
    {
    }
}
