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
        
                $results[] = array(
            'cityName' => 'Bangkok',
            'temperatureForecastDepartureDate' => 29.5
        );
        
                $results[] = array(
            'cityName' => 'Rabat',
            'temperatureForecastDepartureDate' => 23.1
        );
        
                $results[] = array(
            'cityName' => 'Istanbul',
            'temperatureForecastDepartureDate' => 19.3
        );

        $results[] = array(
            'cityName' => 'Athens',
            'temperatureForecastDepartureDate' => 15.1
        );

        $results[] = array(
            'cityName' => 'Tel Aviv',
            'temperatureForecastDepartureDate' => 25.1
        );

        $results[] = array(
            'cityName' => 'Bejing',
            'temperatureForecastDepartureDate' => 20.1
        );

        $results[] = array(
            'cityName' => 'Barcelona',
            'temperatureForecastDepartureDate' => 14.8
        );
                $results[] = array(
            'cityName' => 'Lisbon',
            'temperatureForecastDepartureDate' => 18.9
        );
                $results[] = array(
            'cityName' => 'Cairo',
            'temperatureForecastDepartureDate' => 21.3
        );
                $results[] = array(
            'cityName' => 'San Fransisco',
            'temperatureForecastDepartureDate' => 24.3
        );
                $results[] = array(
            'cityName' => 'Lod Angeles',
            'temperatureForecastDepartureDate' => 28.3
        );
                $results[] = array(
            'cityName' => 'Mexico City',
            'temperatureForecastDepartureDate' => 31.3
        );
                $results[] = array(
            'cityName' => 'Caracas',
            'temperatureForecastDepartureDate' => 30.3
        );
                $results[] = array(
            'cityName' => 'Sao Paulo',
            'temperatureForecastDepartureDate' => 31.1
        );

                $results[] = array(
            'cityName' => 'Santiago',
            'temperatureForecastDepartureDate' => 34.1
        );
        
                        $results[] = array(
            'cityName' => 'Jakarta',
            'temperatureForecastDepartureDate' => 35.1
        );
        
                        $results[] = array(
            'cityName' => 'Tokyo',
            'temperatureForecastDepartureDate' => 18.8
        );
        
        
        return $results;
    }

}
