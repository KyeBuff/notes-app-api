<?php

require (APPPATH.'/libraries/REST_Controller.php'); 
require (APPPATH.'/libraries/Format.php');

use Restserver\Libraries\REST_Controller;

class Notes extends REST_Controller {

	private $rules = [
		[
				'field' => 'title',
				'label' => 'title',
				'rules' => 'required'
		],
		[
				'field' => 'content',
				'label' => 'content',
				'rules' => 'required'
		],
	];
    
    public function __construct(){
		parent::__construct();
		$this->load->model('note');
		$this->load->library('form_validation');
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
		$data = $this->post();

		$data = $this->form_validation->set_data($data);
		$this->form_validation->set_rules($this->rules);

		$note = Note::create($title, $content);

		if($this->form_validation->run()==FALSE){
			$this->response($this->form_validation->error_array(), 422);
		}
		else{
			$this->response($data, 201);
		}
		
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
