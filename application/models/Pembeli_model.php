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
        return $this->db->insert('users', $data);
    }

    public function getOneUser($id)
    {
        $this->db->select('users.id, first_name, GROUP_CONCAT(name SEPARATOR ", ") as daftar_role', FALSE);
        $this->db->from('users');
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');
        $this->db->where('users.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function updateLocation($id, $latitude, $longitude)
    {   
		$point = 'POINT(' . (float) $longitude . ' ' . (float) $latitude . ')';
		$version = $this->db->version();

		// Check if running MySQL 8.0+ (and not MariaDB)
		$isMySQL8 = (stripos($version, 'MariaDB') === FALSE && version_compare($version, '8.0.0', '>='));

		if ($isMySQL8) {
			$geomSql = "ST_GeomFromText(" . $this->db->escape($point) . ", 4326, 'axis-order=long-lat')";
		} else {
			$geomSql = "ST_GeomFromText(" . $this->db->escape($point) . ", 4326)";
		}

		$this->db->set('user_id', $id);
		$this->db->set('location', $geomSql, FALSE);
		$this->db->set('time_location', 'CURRENT_TIMESTAMP', FALSE);

		return $this->db->insert('users_locations');
    }

    
    public function getPenjualAktif()
    {
        return $this->db
        ->select('id, store_name, description, phone')
        ->where('active_selling', 1)
        ->where('phone !=', '')
        ->where('phone !=', '0')
        ->get('users')
        ->result();
    }

    public function getRadiusPenjual($pembeli_id, $radius = 500)
    {   
        // 1. Ambil Koordinat dari pembeli
        $this->db->select("ST_X(location) as longitude, ST_Y(location) as latitude");
        $this->db->from('users_locations');
        $this->db->where('user_id', $pembeli_id);
        $this->db->order_by('time_location', 'DESC');
        $this->db->limit(1);
        $pembeli = $this->db->get()->row_array();

        if (!$pembeli || empty($pembeli['latitude']))
        {
            return [];
        }

        $p_lat = $pembeli['latitude'];
        $p_lng = $pembeli['longitude'];

        // Posisi pembeli 
        // $pembeli_point = "POINT($p_lng $p_lat)";

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
            users.template_text,
            ST_X(ul.location) as longitude,
            ST_Y(ul.location) as latitude,
            ST_Distance_Sphere(ul.location, ST_GeomFromText('POINT({$p_lng} {$p_lat})', 4326)) as jarak_meter,
            categories.type
            ", FALSE);

        $this->db->from('users');
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');

        $this->db->join('category_sellers', 'category_sellers.user_id = users.id');
        $this->db->join('categories', 'categories.id = category_sellers.category_id');

        $this->db->join("($user) ul", 'ul.user_id = users.id');

        $this->db->where('groups.name', 'penjual');
        $this->db->where('users.active_selling', 1);

        $this->db->having('jarak_meter <=', $radius);
        $this->db->order_by('jarak_meter', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }

        // public function getPenjualRadius($id, $radius = 3000)
        // {
        //     $user = $this->getOnePembeli($id);
    
        //     if (!$user) 
        //         {
        //             return [];
        //         }
        //     $user_lat = $user['latitude'];
        //     $user_lng = $user['longitude'];
    
        //     $this->db->select("id, nama,
        //     ST_X(location) as latitude, ST_Y(location) as longitude, ST_Distance_Sphere(location, ST_GeomFromText('POINT($user_lat $user_lng)', 4326)) as jarak_meter", FALSE);
    
        //     $this->db->from('penjual');
    
        //     $this->db->having('jarak_meter <=', $radius);
    
        //     $this->db->order_by('jarak_meter', 'ASC');
    
        //     $query = $this->db->get();
        //     return $query->result_array();
        // }
}
