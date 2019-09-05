<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class homepage extends CI_Controller {

    public function index()
    {
        if($this->session->userdata('username') != null){
            $this->load->model('wishlist_model');
            $data['wishlistID'] = $this->wishlist_model->getWishlistID();
            $this->load->view('wishlist', $data);
        }else{
            redirect('/userlogin');
        }
    }

    function share($id){
        $this->load->model('user_model');
        $data['wishlistID'] = $id;
        $this->load->model('wishlist_model');
        $wishlist = $this->wishlist_model->getWishlistdetails($id);
        if(sizeof($wishlist)>0){
            $data['name'] = $wishlist[0]->name;
            $data['description'] = $wishlist[0]->description;
            $data['owner'] = $wishlist[0]->username;
        }
        $this->load->view('share_view', $data);
    }
}
