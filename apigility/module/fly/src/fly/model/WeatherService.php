<?php

namespace fly\model;

Class WeatherService {

    public function getListOfPossibleDestinations($weatherType, $date) {
        
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

        $countries = json_decode(file_get_contents(__DIR__.'/countriestocities.json'));
        

        
        $result = array();


foreach ($countries as $countryId => $country) { foreach ($country as $cities) { var_dump($countryId, $cities);}}

        
        $result[] = array(
            'cityName' => 'Dubai',
            'temperatureForecastDepartureDate' => 25.7
        );
        $result[] = array(
            'cityName' => 'Miami',
            'temperatureForecastDepartureDate' => 28.1
        );

        return $results;
    }

}
