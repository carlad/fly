<?php
namespace fly\V1\Rest\Search;

class SearchResourceFactory
{
    public function __invoke($services)
    {
        return new SearchResource();
    }
}
