<?php

require (APPPATH.'/libraries/REST_Controller.php'); 
require (APPPATH.'/libraries/Format.php');

use Restserver\Libraries\REST_Controller;

class Notes extends REST_Controller {
    
    public function __construct(){
		parent::__construct();
		$this->load->model('note');
    }
	/**
	 * Index all notes
	 */
	public function index_get()
	{
    }

    /**
	 * Fetch note by id
	 */
	public function index_id_get()
	{
    }
    
    /**
	 * Create a note
	 */
	public function index_post()
	{
		$title = $this->post('title');
		$content = $this->post('content');

		$note = Note::create($title, $content);

		$this->response($note, 201);
    }
    
    /**
	 * Update a note
	 */
	public function index_put()
	{
    }
    
    /**
	 * Delete a note
	 */
	public function index_delete()
	{
	}
}
