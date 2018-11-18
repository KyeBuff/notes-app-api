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

	private $fillables = [
		'title',
		'content'
	];

	private function matchesFillables($data)
	{
		$matches = true;

		foreach ($data as $field => $value) {
			if(!in_array($field, $this->fillables)) {
				$matches = false;
				break;
			}
		}

		return $matches;
	}
    
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
		if($id = $this->get('id')) 
		{
			$this->get_by_id($id);
		}
		$this->response(Note::get(), 200);
    }

    /**
	 * Fetch note by id
	 */
	private function get_by_id($id)
	{
		$note = Note::getOne($id);
		$note ? $this->response($note, 200) : $this->response(null, 404);
    }
    
    /**
	 * Create a note
	 */
	public function index_post()
	{
		$data = $this->post();

		if(!$this->matchesFillables($data)){
			$this->response(['message' => 'Mass assignment error'], 422);
		}

		$this->form_validation->set_data($data);
		$this->form_validation->set_rules($this->rules);

		if(!$this->form_validation->run()){
			$this->response($this->form_validation->error_array(), 422);
		}

		$note = Note::create($data);

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
