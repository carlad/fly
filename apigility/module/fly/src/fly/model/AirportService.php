<?php

namespace fly\model;

Class AirportService {

    public function __construct() {
        $this->config = new Config();
    }

    public function getCityAirportMap() {

        $map = array();
        $map['DXB'] = 'Dubai';
        $map['MIA'] = 'Miami';
        $map['TUN'] = 'Tunis';
        $map['BKK'] = 'Bangkok';
        $map['RBA'] = 'Rabat';
        $map['IST'] = 'Istanbul';
        $map['ATH'] = 'Athens';
        $map['TLV'] = 'Tel Aviv';
        $map['BJS'] = 'Bejing';
        $map['BCN'] = 'Barcelona';
        $map['LIS'] = 'Lisbon';
        $map['CAI'] = 'Cairo';
        $map['SFO'] = 'San Fransisco';
        $map['LAX'] = 'Los Angeles';
        $map['MEX'] = 'Mexico City';
        $map['CCS'] = 'Caracas';
        $map['GRU'] = 'Sao Paulo';
        $map['SCQ'] = 'Santiago';
        $map['CGK'] = 'Jakarta';
        $map['HND'] = 'Tokyo';

        return $map;
    }

    public function mapAirportCodeToCity($airportCode) {
        $map = $this->getCityAirportMap();

        if (array_key_exists($airportCode, $map)) {
            return $map[$airportCode];
        } else {
            throw new \Exception("No airport to city mapping found for '{$airportCode}'");
        }
    }

    public function mapCityToAirportCode($string) {

        $map = $this->getCityAirportMap();

        foreach ($map as $key => $city) {

            if ($string == $city) {
                return $key;
            }
        }

        // did not found anything
        throw new \Exception("No city to airport mapping found for '{$string}'");
    }

    public function getAirports($countryCode) {
        $httpClient = new \Zend\Http\Client();
        $httpClient->setOptions(array(
            'maxredirects' => 5,
            'timeout' => 30
        ));

        $uri = "https://api.lufthansa.com/v1/references/airports/TXL?lang=DE&lh_location=1&api_key=" . $this->config->getLufthansaApikey();

        $httpClient->setUri($uri);

        // hard code some airports because API did not work with client


        return array(
            array('cityCode' => 'BER', 'cityName' => 'Berlin'),
            array('cityCode' => 'CGN', 'cityName' => 'Köln'),
            array('cityCode' => 'DUS', 'cityName' => 'Düsseldorf'),
            array('cityCode' => 'FRA', 'cityName' => 'Frankfurt'),
            array('cityCode' => 'HAM', 'cityName' => 'Hamburg'),
            array('cityCode' => 'HAJ', 'cityName' => 'Hannover'),
            array('cityCode' => 'MUC', 'cityName' => 'München'),
            array('cityCode' => 'NUE', 'cityName' => 'Nürnberg'),
            array('cityCode' => 'STR', 'cityName' => 'Stuttgart')
        );
    }

}
