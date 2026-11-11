<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembeli_model extends CI_Model {

    public function login($email)
    {
        $query = $this->db->get_where('pembeli', array('email' => $email));
        $result = $query->row();
        return $result;
    }

    public function register($data)
    {
        $this->db->insert('pembeli', $data);
        return;
    }

    public function getOnePembeli($id)
    {
        $this->db->select("id, name, ST_X(location) as longitude, ST_Y(location) as latitude");
        $this->db->from('pembeli');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
        
    }

    public function updateLocation($id, $latitude, $longitude)
    {    
        $location = "ST_GeomFromText('POINT($latitude $longitude)', 4326)";
        $this->db->set('location', $location, FALSE);
        $this->db->where('id', $id);
        return $this->db->update('pembeli');
    }

    public function getPenjualRadius($id, $radius = 3000)
    {
        $user = $this->getOnePembeli($id);

        if (!$user) 
            {
                return [];
            }
        $user_lat = $user['latitude'];
        $user_lng = $user['longitude'];

        $this->db->select("id, name,
        ST_X(location) as longitude, ST_Y(location) as latitude, ST_Distance_Sphere(location, ST_GeomFromText('POINT($user_lng $user_lat)', 4326)) as jarak_meter", FALSE);

        $this->db->from('penjual');

        $this->db->having('jarak_meter <=', $radius);

        $this->db->order_by('jarak_meter', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }
}