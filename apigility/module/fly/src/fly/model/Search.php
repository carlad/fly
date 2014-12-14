<?php

namespace fly\model;

Class Search {

    public function __construct() {
        $this->weatherService = new WeatherService();
        $this->flightService = new FlightService();
        $this->airportService = new AirportService();
    }

    public function getResults($originCity, $weatherType, $fromDate, $toDate) {

        $possibleDestinations = $this->weatherService->getListOfPossibleDestinations($weatherType, $fromDate);

        $results = array();

        foreach ($possibleDestinations as $possibleDestination) {
            try {
                $dst = $this->airportService->mapCityToAirportCode($possibleDestination["cityName"]);


                $flight = $this->flightService->findCheapestFlight($originCity, $dst, $fromDate, $toDate);
                if ($flight) {
                    $flight["weather"] = array(
                        "temperatureForecastDepartureDate" => $possibleDestination["temperatureForecastDepartureDate"],
                    );
                    $results[] = $flight;
                }
            } catch (\Exception $e) {
                error_log($e->getMessage()); 
            }
        }
        
           // sort by price
        usort($results, function($a, $b) {
            return $a['price']['totalPrice'] - $b['price']['totalPrice'];
        });
        

        return $results;
    }

}
