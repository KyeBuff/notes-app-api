<?php

require (APPPATH.'/libraries/REST_Controller.php'); 
require (APPPATH.'/libraries/Format.php');

use Restserver\Libraries\REST_Controller;

class Notes extends REST_Controller {
    
    public function __construct(){
		parent::__construct();
		$this->load->library('rb');
    }
	/**
	 * Index all notes
	 */
	public function index_get()
	{
		$post = R::dispense('post');
		$post->text = 'Hello World';

		$id = R::store($post);       //Create or Update
		$post = R::load('post',$id); //Retrieve
		R::trash($post); 
        // Returns a list of notes
        // $this->response($this->db->get('notes')->result());
    }

    /**
	 * Index all notes
	 */
	public function index_id_get()
	{
        // Returns a list of notes
        // $this->response($this->db->get('notes')->result());
    }
    
    /**
	 * Index all notes
	 */
	public function index_post()
	{
        // Returns a list of notes
        // $this->response($this->db->get('notes')->result());
    }
    
    /**
	 * Index all notes
	 */
	public function index_put()
	{
        // Returns a list of notes
        // $this->response($this->db->get('notes')->result());
    }
    
    /**
	 * Index all notes
	 */
	public function index_delete()
	{
        // Returns a list of notes
        // $this->response($this->db->get('notes')->result());
	}
}
