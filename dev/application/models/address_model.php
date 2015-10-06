<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 11/5/14
 * Time: 17:01
 */

class Address_model extends MY_Model {

    private $countryKey = "as_country_with_code";
    private $stateKey = "as_states";
    private $cityKey = "as_cities";

    public function __construct()
    {
        parent::__construct();
//        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    }

    public function getCountryWithCode(){
//        $countryInfo = $this->cache->get($this->countryKey);
//        if ($countryInfo) {
//            return $countryInfo;
//        } else {
//            $this->db->select("countryCode, name");
//            $this->db->from("country");
//            $this->db->where("active", 1, false);
//            $this->db->order_by("name", "ASC");
//
//            $countryInfo = $this->db->get()->result();
//
//            // Save into the cache for 30 days
//            $this->cache->save($this->countryKey, $countryInfo, 2592000);
//        }

        $countryInfo = $this->azure->select("country", array("countryCode","name"), "active = 1 AND name <>''", "name ASC");

        return $countryInfo;
    }

    public function getStates(){
//        $stateInfo = $this->cache->get($this->stateKey);
//        if ($stateInfo) {
//            return $stateInfo;
//        } else {
//            $this->db->select("name");
//            $this->db->from("state");
//            $this->db->where("active", 1, false);
//            $this->db->order_by("name", "ASC");
//
//            $stateInfo = $this->db->get()->result();
//
//            // Save into the cache for 30 days
//            $this->cache->save($this->stateKey, $stateInfo, 2592000);
//        }

        $stateInfo = $this->azure->select("state", array("name"), "active = 1 AND name <>''", "name ASC");

        return $stateInfo;
    }

    public function getCities(){
//        $cityInfo = $this->cache->get($this->cityKey);
//        if ($cityInfo) {
//            return $cityInfo;
//        } else {
//            $this->db->select("name");
//            $this->db->from("city");
//            $this->db->where("active", 1, false);
//            $this->db->order_by("name", "ASC");
//
//            $cityInfo = $this->db->get()->result();
//
//            // Save into the cache for 30 days
//            $this->cache->save($this->cityKey, $cityInfo, 2592000);
//        }
        $cityInfo = $this->azure->select("city", array("name"), "active = 1 AND name <>''", "name ASC");

        return $cityInfo;
    }

}