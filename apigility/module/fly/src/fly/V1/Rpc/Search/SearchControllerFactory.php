<?php
namespace fly\V1\Rpc\Search;

class SearchControllerFactory
{
    public function __invoke($controllers)
    {
        return new SearchController();
    }
}
