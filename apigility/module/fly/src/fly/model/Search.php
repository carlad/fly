<?php

namespace fly\model;

Class Search {
    
    public function __construct() {
        $this->weatherService = new WeatherService();
        // $this->flightService = new FlightService();
    }

    public function getResults($weatherType, $fromDate, $toDate) {
        
        $possibleDestinations = $this->weatherService->getListOfPossibleDestinations($weatherType, $fromDate);
        
        
        foreach ($possibleDestinations as $possibleDestination) {
            
            // $this->flightService->findFlights($destionation,$fromDate,$toDate)
            
            
        }
        
        
        
        

        $results = array();


        $trip = array();
        $trip["destination"] = array(
            "cityName" => "Dubai",
            "airportCode" => "DXB"
        );

        $trip["flightInformation"] = array(
            "distanceMiles" => 1234,
            "flightDurationMinutes" => 330
        );


        $trip["weather"] = array(
            "temperatureForecastDepartureDate" => 25.7,
            "magdaFactor" => 2,
            "carlaLiking" => 5
        );
        $trip["price"] = array(
            "totalPrice" => 540,
            "currency" => "EUR"
        );

        $results[] = $trip;
        $results[] = $trip;

        return $results;
    }

}
