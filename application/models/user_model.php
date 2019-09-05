<?php

class user_model extends CI_Model{

    function addUser($data){
        $this->db->insert('category', $data);
    }

    function userAuthentication($username, $password){
        if($this->db->get_where('users', array('username' => $username, 'password' => $password))->num_rows() == 1){
            $this->session->set_userdata('username', $username);
            return true;
        } else {
            return false;
        }
    }

    public function register($username,$password, $name, $description){
        $data = array(
            'username'=>$username,
            'password' => $password
        );
        $wishlist = array(
            'username'=>$username,
            'name'=>$name,
            'description'=>$description
        );
        $this->db->insert('users', $data);
        $this->db->insert('wishlist', $wishlist);
        $response = $this->db->affected_rows();
        return $response;
    }
}