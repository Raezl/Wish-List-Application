<?php

class wishlist_model extends CI_Model{

    function getWishlistID(){
        $this->db->where('username', $this->session->userdata('username'));
        $va = $this->db->get('wishlist');
        return $va->result();
    }


    function getWishlistdetails($id){
        $this->db->where('wishlistID', $id);
        $va = $this->db->get('wishlist');
        return $va->result();
    }


    function addItem($data){
        $this->db->insert('items', $data);
    }

    function removeItem($id){
        $this->db->where('itemsID', $id);
        $this->db->delete('items');
    }


    function deleteItem($id){
        $this->db->where('itemID', $id);
        $this->db->delete('items');
    }

    function updateItem($data){
        $this->db->where('itemID',$data['itemID']);
        $this->db->update('items',$data);
    }

    function viewList($wishlistID){
        $this->db->where('wishlistID', $wishlistID);
        //$this->db->order_by('priority', 'DESC');
        $query = $this->db->get('items');
        return $query -> result();
    }
}