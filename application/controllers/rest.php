<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
require APPPATH. 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

class rest extends  REST_Controller{

    public function userdetail_post()
    {
        $this->load->model('user_model');
        $data = $this->user_model->userAuthentication($this->post('username'), $this->post('password'));
        if ($data) {
            $this->response('Success', 200);
        } else {
            $this->response('Failed', 300);
        }
    }

    public function register_post(){
        $this->load->model('user_model');

        $username = $this->post('username');
        $password = $this->post('password');
        $name = $this->post('name');
        $description = $this->post('description');

        $response = $this->user_model->register($username, $password,$name,$description);

        if ($response == 1){
            $this->response('Success', 200);
        } else {
            $this->response('Failed', 400);
        }
    }

    //get wish list item
    function item_get(){
        $this->load->model('wishlist_model');
        $id = $this->wishlist_model->getWishListID();
        $d = $this->wishlist_model->viewList($id[0]->wishlistID);
        $this->response($d,200);
    }

    function item_post()
    {
        $this->load->model('wishlist_model');
        $id = $this->wishlist_model->getWishlistID();
        $data =array(
            'wishlistID' => $id[0]->wishlistID,
            'title' => $this->post('title'),
            'URL' => $this->post('URL'),
            'priority' => $this->post('priority')
        ) ;


        $data = $this->wishlist_model->additem($data);
        $this->response(json_encode($data), 200);
    }

    function item_put()
    {
        $data =array(
            'itemID' => $this->put('itemID'),
            'wishlistID' => $this->put('wishlistID'),
            'title' => $this->put('title'),
            'URL' => $this->put('URL'),
            'priority' => $this->put('priority')
        ) ;
        $this->load->model('wishlist_model');
        $data = $this->wishlist_model->updateItem($data);
        $this->response(json_encode($data));
}


function item_delete($id)
    {
        $this->load->model('wishlist_model');
        $q = $this->wishlist_model->deleteItem($id);
        $this->response(json_encode($q));
    }


    public function share_get($id){
        $this->load->model('wishlist_model');
        $wishListItems = $this->wishlist_model->viewList($id);
        $this->response($wishListItems, 200);
    }

}
