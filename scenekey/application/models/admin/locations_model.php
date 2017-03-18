<?php

class Locations_Model extends Common_Model {

    function __construct() {
        parent::__construct();
    }

    // get country by id
    public function getCountry($country_id) {
        $opt = array('where' => array('country_id' => $country_id),
            'table' => 'countries',
            'single' => true
        );
        return $this->customGet($opt);
    }

    // get state by id
    public function getState($state_id) {
        $opt = array('where' => array('state_id' => $state_id),
            'table' => 'states',
            'single' => true
        );
        return $this->customGet($opt);
    }

    // get state by id
    public function getCity($city_id) {
        $opt = array('where' => array('city_id' => $city_id),
            'table' => 'cities',
            'single' => true
        );
        return $this->customGet($opt);
    }

}
