<?php

namespace fly\model;

Class WeatherService {

    public function getListOfPossibleDestinations($weatherType, $date) {

        $useStaticData = true; // do this for performance reasons;

        if ($useStaticData) {
            $results = $this->getStaticForecasts();
        } else {

        $airportService = new AirportService();
        $knownDestinations = $airportService->getCityAirportMap();

        $dateObj = \DateTime::createFromFormat("Y-m-d", $date);

        $results = array();
        foreach ($knownDestinations as $destination) {
            $forecast = $this->getForecastForDateLive($destination, $dateObj);
            if ($forecast) {
                $results[] = $forecast;
            }
        }
        
        }
        
        // filter if temperature is below 22
        
        foreach ($results as $key => $result) {
            if ($result['temperatureForecastDepartureDate'] <= 22) {
                unset ($results[$key]);
            }
        }

        return $results;
    }

    public function getStaticForecasts() {
        $results = array();
        
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
        
        
        // get more random temperatures
        foreach ($results as $key => $result) {
            $results[$key]['temperatureForecastDepartureDate'] = rand(150,345)/10;
        }


        return $results;
    }

    public function getForecastForDateLive($city, \DateTime $date) {

        $httpClient = new \Zend\Http\Client();
        $httpClient->setOptions(array(
            'maxredirects' => 5,
            'timeout' => 2
        ));

        $apiUrl = "http://api.openweathermap.org/data/2.5/forecast/daily?mode=json&APPID=d4fdc53f3bde947e7a3282e78789378a";

        $uri = $apiUrl . '&q=London&cnt=14';

        $httpClient->setUri($uri);
        $httpClient->send();

        $response = $httpClient->getResponse()->getBody();
        $json = \Zend\Json\Json::decode($response, \Zend\Json\Json::TYPE_ARRAY);

        $forecasts = $json['list'];



        foreach ($forecasts as $forecast) {
            $forecastDate = \DateTime::createFromFormat('U', $forecast['dt']);

            $reqDateF = $date->format('Y-m-d');
            $forecastDateF = $forecastDate->format('Y-m-d');

            if ($reqDateF == $forecastDateF) {
                return array(
                    'cityName' => $city,
                    'temperatureForecastDepartureDate' => ($forecast['temp']['day'] - 273.15 + 20)
                );
            }
        }

        return null;
    }

}
