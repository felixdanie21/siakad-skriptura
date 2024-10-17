<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Dosen extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function data_get()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, x-userkey');
        $headers = apache_request_headers();
        $cek_userkey = array_key_exists('x-userkey',$headers);
        if($cek_userkey){
            $userkey = $headers['x-userkey'];
            if($userkey == 'rest_api_siakad_skriptura'){
                $iddosen = $this->get( 'iddosen' );
                $namadosen = $this->get( 'namadosen' );
                if($iddosen){
                    $this->db->where('iddosen',$iddosen);
                }
                if($namadosen){
                    $this->db->like('namadosen',$namadosen);
                }
                $this->db->order_by('namadosen', 'ASC');
                $mdosen = $this->db->get('mdosen')->result_array();
                $this->response([
                    'response'=> $mdosen,
                    'metadata'=>[
                        'message' => 'Ok',
                        'code' => 200
                    ]
                ],200);
            } else {
                $this->response([
                    'metadata' => [
                        'message' => 'Userkey tidak sesuai',
                        'code' => 201
                    ]
                ],201);
            }
        } else {
            $this->response([
                'metadata' => [
                    'message' => 'Header kosong',
                    'code' => 201
                ]
            ],201);
        }

      
        if ( $id === null )
        {
            // Check if the users data store contains users
            if ( $users )
            {
                // Set the response and exit
                $this->response( $users, 200 );
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'No users were found'
                ], 404 );
            }
        }
        else
        {
            if ( array_key_exists( $id, $users ) )
            {
                $this->response( $users[$id], 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such user found'
                ], 404 );
            }
        }
    }
}