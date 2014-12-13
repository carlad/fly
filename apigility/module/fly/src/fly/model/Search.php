<?php

namespace fly\model;

Class Search {

    public function getResults() {

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
    }

}
