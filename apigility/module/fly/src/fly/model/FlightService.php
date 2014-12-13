<?php

namespace fly\model;

Class FlightService {

    /**
     *
     * @var \Zend\Http\Client
     */
    private $httpClient;
    
    private $airportService;

    public function __construct() {
        $this->airportService = new AirportService();
        $this->httpClient = new \Zend\Http\Client();
        $this->httpClient->setOptions(array(
            'maxredirects' => 5,
            'timeout' => 30
        ));
        
        $this->config = new Config();
    }

    private function doRequest($params, $responseMode = "light") {
        $client = $this->httpClient;
        $request = array();
        
        $request["User"] = $this->config->getFastSearchUser();
        $request["Pass"] = $this->config->getFastSearchApikey();
        
        $request["Environment"] = "lh-vzg";
        $request["Response"] = $responseMode;

        $fullRequest = array_merge($request, $params);


        $client->setUri($this->config->getFastSearchHost());
        $client->setMethod('POST');
        $client->setRawBody(json_encode($fullRequest));
        $client->setEncType("application/json");



        $response = $client->send();

        $responseJson = $response->getBody();
        $json = \Zend\Json\Json::decode($responseJson, \Zend\Json\Json::TYPE_ARRAY);
        return $json['Journeys'];
    }

    public function getFlightDetails($from, $to, $fromDate, $toDate, $class = 'Economy') {
        try {
            $search = array();

            $search["Origin"] = $from;
            $search["Destination"] = $to;
            $search["DepartureFrom"] = $fromDate;
            $search["LengthOfStay"] = array(5);

            $search["Passengers"] = array(
                array("Type" => "ADT", "Count" => 1)
            );

            $flightsRaw = $this->doRequest($search);

            $flights = array();

            foreach ($flightsRaw as $flightRaw) {
                $flight = array();
                $flight["price"] = array(
                    "totalPrice" => $flightRaw['Price'],
                    "currency" => $flightRaw['Currency']
                );

                $flight["flightInformation"] = array(
                    "flightDurationMinutes" => $flightRaw['OutboundTotalTravelMinutes']
                );
                $miles = 0;
                foreach ($flightRaw['OutboundFlights'] as $outboundFlight) {
                    $miles = $miles + $outboundFlight["EQP"];
                }
                $flight["flightInformation"]["distanceMiles"] = $miles;
                $flight["destination"] = array(
                    "cityName" => $this->airportService->mapAirportCodeToCity($to),
                    "airportCode" => $to
                );


                $flights[] = $flight;
            }
        } catch (\Exception $e) {
            error_log($e->getMessage());
        }




        return $flights;
    }

    public function findFlights($from, $to, $fromDate, $toDate) {

        return $this->getFlightDetails($from, $to, $fromDate, $toDate);
    }

    public function findCheapestFlight($from, $to, $fromDate, $toDate) {
        $allFlights = $this->getFlightDetails($from, $to, $fromDate, $toDate);

        $cheapestFlight = null;

        foreach ($allFlights as $flight) {

            if (is_null($cheapestFlight) || ($flight['price']['totalPrice'] < $cheapestFlight['price']['totalPrice'])) {
                $cheapestFlight = $flight;
            }
        }

        return $cheapestFlight;
    }

}
