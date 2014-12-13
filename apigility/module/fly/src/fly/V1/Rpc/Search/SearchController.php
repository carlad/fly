<?php
namespace fly\V1\Rpc\Search;

use Zend\Mvc\Controller\AbstractActionController;

class SearchController extends AbstractActionController
{
    
    function __construct() {
        
        $this->mapper = new \fly\model\Search();
        
    }

    
    public function searchAction()
    {
    		#die('2345');
        $weatherType = 'sunny';
        $fromDate = '2014-12-04';
        $toDate = '2014-12-20';
        $results = $this->mapper->getResults($weatherType, $fromDate, $toDate);
        return $results;
        
    }
}
