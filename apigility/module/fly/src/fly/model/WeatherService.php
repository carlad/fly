<?php

namespace fly\model;

Class WeatherService {

    public function getListOfPossibleDestinations($weatherType, $date) {
        
        
        //$countries = json_decode(file_get_contents(__DIR__.'/countriestocities.json'));
        
        /*
         * Go to a weather service
         * 
         * query forecaast for a bunch of cities in one call for that date
         * 
         * iterate through the result, filter for matching cities"
         * 
         * return array of city codes
         * 
         * 
         * 
         *  "weather": {
                        "temperatureForecastDepartureDate": 25.7,
                        "magdaFactor": 2,
                        "carlaLiking": 5
                    },
         */
        
        $airportService = new AirportService();
        
        $knownDestinations = $airportService->getCityAirportMap();
        
        
        $dateObj = \DateTime::createFromFormat("Y-m-d", $date);
        
        foreach ($knownDestinations as $destination) {
            $this->getForecastForDateLive($destination, $dateObj);
            
            
            
        }
        
        

        
        $results = array();


#foreach ($countries as $countryId => $country) { foreach ($country as $cities) { var_dump($countryId, $cities);}}

        
        $results[] = array(
            'cityName' => 'Dubai',
            'temperatureForecastDepartureDate' => 25.7
        );
        $results[] = array(
            'cityName' => 'Miami',
            'temperatureForecastDepartureDate' => 28.1
        );
        
        $results[] = array(
            'cityName' => 'Tunis',
            'temperatureForecastDepartureDate' => 23.1
        );
        

        return $results;
        
    }

    public function getForecastForDateLive($city, \DateTime $date) {
     
        $httpClient = new \Zend\Http\Client();
        $httpClient->setOptions(array(
            'maxredirects' => 5,
            'timeout' => 2
        ));
        
        $apiUrl = "http://api.openweathermap.org/data/2.5/forecast/daily?mode=json";
        
        $uri = $apiUrl . '&q=London&cnt=14';
        
        $httpClient->setUri($uri);
        $httpClient->send();
        
        $response = $httpClient->getResponse()->getBody();
        $json = \Zend\Json\Json::decode($response, \Zend\Json\Json::TYPE_ARRAY);
        
        $forecasts = $json['list'];
        
        
        foreach ($forecasts as $forecast) {
            $forecastDate = new \DateTime(strtotime($forecast['dt']));
            var_dump($forecastDate);
        }
        
        die('asaas');
        
        
        
    }
        
        

}
