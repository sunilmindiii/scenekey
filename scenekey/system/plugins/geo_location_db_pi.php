<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Geo Location Plugin for Local DB
 *
 * @package            CodeIgniter
 * @author            Remko Posthuma
 * @subpackage        System
 * @category            Plugin
 * @since            Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/*
  Instructions:

  Database needs to be autoload from CI config.

  Download the 'Complete (City)' IP database SQL from:
  http://www.ipinfodb.com/ip_database.php

  Import the data into your MySQL database using the SQL statement and check if
  the table 'ip_group_city' is created

  Load the plugin using:
  $this->load->plugin('geo_location_db');

  Once loaded you can get user's geo location details by given IP address:
  $ip = $this->input->ip_address();
  $geo_data = get_geolocation($ip);

  echo "Country code : ".$geo_data->country_name."<br>\n";
  echo "Country name : ".$geo_data->city."<br>\n";
  echo "Latitude     : ".$geo_data->latitude."<br>\n";
  echo "Longitude    : ".$geo_data->longitude."<br>\n";
  ...

  Or let the plugin detect the ip
  $geo_data = get_geolocation_get_ip();

  echo "Country code : ".$geo_data->country_name."<br>\n";
  echo "Country name : ".$geo_data->city."<br>\n";
  echo "Latitude     : ".$geo_data->latitude."<br>\n";
  echo "Longitude    : ".$geo_data->longitude."<br>\n";
  ...

  RETURNED DATA

  The get_geolocation() and get_geolocation_get_ip() function returns an associative array.
  Use var_dump the check the structure
 */


/**
 * Get Geo Location by Given/Current IP address for local database
 *
 * @access    public
 * @param    string
 * @return    array
 */
if (!function_exists('get_geolocation')) {

    function get_geolocation_get_ip() {
        $CI = & get_instance();
        $ip = $CI->input->ip_address();
        $geo_data = get_geolocation($ip);
        return($geo_data);
    }

    function get_geolocation($ip) {
        $CI = & get_instance();
        $sql = 'SELECT * FROM `ip_group_city` where `ip_start` <= INET_ATON(' . "'" . $CI->db->escape_str($ip) . "'" . ') order by ip_start desc limit 1;';
        $query = $CI->db->query($sql);
        if ($query->num_rows() == 1) {
            $row = $query->row();
            $result->ip = ($ip);
            $result->code = 'OK';
            $result->country_code = ($row->country_code);
            $result->country_name = ($row->country_name);
            $result->region_name = ($row->region_name);
            $result->city = ($row->city);
            $result->zip_postal_code = ($row->zipcode);
            $result->latitude = ($row->latitude);
            $result->longitude = ($row->longitude);
            $result->timezone = ($row->timezone);
            $result->gmtoffset = ($row->gmtOffset);
            $result->dstoffset = ($row->dstOffset);
        } else {
            $result->ip = ($ip);
            $result->code = 'IP NOT FOUND';
            $result->country_code = '';
            $result->country_name = '';
            $result->region_name = '';
            $result->city = '';
            $result->zip_postal_code = '';
            $result->latitude = '';
            $result->longitude = '';
            $result->timezone = '';
            $result->gmtoffset = '';
            $result->dstoffset = '';
        }
        return($result);
    }

}
/* End of file geo_location_db_pi.php */
/* Location: ./system/plugins/geo_location_db_pi.php */
