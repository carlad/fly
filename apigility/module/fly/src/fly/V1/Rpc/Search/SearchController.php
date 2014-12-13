<?php
namespace fly\V1\Rpc\Search;

use Zend\Mvc\Controller\AbstractActionController;

class SearchController extends AbstractActionController
{
    
    function __construct() {
        
        $this->mapper = new fly\model\Search();
        
    }

    
    public function searchAction()
    {
        $results = $this->mapper->getResults();
        return $results;
        
    }
}
