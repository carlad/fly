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
        $originCity = $this->getRequest()->getQuery('originCity');
        if ($originCity == 'BER') {
            $originCity = "TXL";
        }
        
        $weatherType = 'sunny';
        $fromDate = '2015-01-03';
        $toDate = '2015-02-20';
        $results = $this->mapper->getResults($originCity,$weatherType, $fromDate, $toDate);
        return $results;
        
    }
}
