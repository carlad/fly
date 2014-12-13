<?php
namespace fly\V1\Rest\Supportedorigins;

class SupportedoriginsResourceFactory
{
    public function __invoke($services)
    {
        return new SupportedoriginsResource();
    }
}
