<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LocationtrackModel extends CI_Model {

    public function get_all_locations() {
            $this->db->select('name, latitude, longitude');
            $this->db->from('tbl_location');
            $this->db->where('latitude IS NOT NULL');
            $this->db->where('longitude IS NOT NULL');
        
            $query = $this->db->get();
            return $query->result(); 
        }
        

    }

?>
