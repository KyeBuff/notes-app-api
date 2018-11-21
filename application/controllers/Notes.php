<?php

require (APPPATH.'/libraries/REST_Controller.php'); 
require (APPPATH.'/libraries/Format.php');

use Restserver\Libraries\REST_Controller;

class Notes extends REST_Controller {

	private $rules = [
		'new' => [
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
			[
				'field' => 'author_id',
				'label' => 'author_id',
				'rules' => 'required|numeric'
			],
		],
		'update' => [
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
		],
	];

	private $fillables = [
		'title',
		'content',
		'author_id'
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
		$this->load->model('author');
		$this->load->library('form_validation');
    }
	/**
	 * Index all notes
	 */
	public function index_get()
	{
		if($this->get()) {
			$id = $this->get('id');
			if($id) {
				$this->get_by_id($id);
			}
			$this->response(null, 404);
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
		$this->form_validation->set_rules($this->rules['new']);

		if(!$this->form_validation->run()){
			$this->response($this->form_validation->error_array(), 422);
		}

		$note = Note::create($data);

		//Set note to author
		$author = Author::getAuthor($data['author_id']);

		if ($author) {
			Author::setNote($note, $data['author_id']);
		}

		$this->response($note, 201);
		
    }
    
    /**
	 * Update a note
	 */
	public function note_put()
	{

		$data = $this->put();

		if(!$this->matchesFillables($data)){
			$this->response(['message' => 'Mass assignment error'], 422);
		}
	
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules($this->rules['update']);

		if(!$this->form_validation->run()){
			$this->response($this->form_validation->error_array(), 422);
		}
		
		if($id = $this->get('id')) {
			$note = Note::getOne($id);
			if($note) {
				$note = Note::update($this->put(), $id);
				$this->response($note, 200);
			}
			$this->response(null, 404);
		}
		$this->response(null, 404);
    }
    
    /**
	 * Delete a note
	 */
	public function note_delete()
	{
		if($id = $this->get('id')) {
			$note = Note::getOne($id);
			if($note) {
				Note::delete($id);
				$this->response(null, 200);
			}
			$this->response(null, 404);
		}
		$this->response(null, 404);
	}
	public function author_get() 
	{
		$author_id = $this->get('id');

		if($author_id) {
			$author = Author::getAuthor($author_id);

			if($author) {
				$notes = Author::getOwnNotes($author_id);
				$this->response($notes, 200);
			}
			$this->response(null, 404);
		}

		$this->response(null, 404);
	}
}
