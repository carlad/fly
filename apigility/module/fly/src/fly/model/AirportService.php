<?php

namespace fly\model;

Class AirportService {
    
     private function getCityAirportMap() {

        $map = array();
        $map['DXB'] = 'Dubai';
        $map['MIA'] = 'Miami';

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
    
    
    
}

