<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function countPedagang()
    {
        $query = $this->db->get_where('users_groups', array('group_id' => 3));
        return $query->num_rows();
    }

    public function countActivePedagang()
    {
        $query = $this->db->get_where('users', array('active_selling' => 1));
        return $query->num_rows();
    }

    public function countAll()
    {
        $query = $this->db->get('users');
        return $query->num_rows();
    }

    public function getAllUsers()
    {   
        $this->db->select('first_name, last_name, email, phone');
        $this->db->from('users');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllPedagang()
    {
        $this->db->select('users.id, users.store_name, GROUP_CONCAT(categories.type SEPARATOR ", ") AS type, users.active_selling');
        $this->db->from('users');

        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');

        $this->db->join('category_sellers', 'category_sellers.user_id = users.id');
        $this->db->join('categories', 'categories.id = category_sellers.category_id');
        
        $this->db->where('groups.id', 3);
        $this->db->group_by('users.id');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllCategory()
    {
        $this->db->select('type, colour_marker');
        $query = $this->db->get('categories');
        return $query->result_array();
    }

    public function createCategory($data)
    {
        $query = $this->db->insert('categories', $data);
        return $query;
    }

    public function getLocationActive()
    {   
        
        // 2. Mengambil semua id dan mengelompokkan user_id yang sama lalu dicari id yang paling tinggi ( itu adalah lokasi terakhir)
        $location_per_user = $this->db->select_max('id')
                                ->from('users_locations')
                                ->group_by('user_id')
                                ->get_compiled_select();
        
        // 3. Mengambil user dan lokasi terakhir dari query sebelumnya
        $user = $this->db->select('user_id, location')
                ->from('users_locations')
                ->where("id IN ($location_per_user)", NULL, FALSE)
                ->get_compiled_select();
        
        $this->db->select("
            users.id,
            users.username as nama_penjual,
            users.store_name,
            users.phone,
            ST_X(ul.location) as longitude,
            ST_Y(ul.location) as latitude
        ", FALSE);

        $this->db->from('users');
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');

        $this->db->join("($user) ul", 'ul.user_id = users.id');

        $this->db->where('groups.name', 'penjual');
        $this->db->where('users.active_selling', 1);

        $query = $this->db->get();
        return $query->result_array();
    }

}