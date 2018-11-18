<?php

require (APPPATH.'/libraries/REST_Controller.php'); 
require (APPPATH.'/libraries/Format.php');

use Restserver\Libraries\REST_Controller;

class Authors extends REST_Controller {

	private $rules = [
		[
				'field' => 'name',
				'label' => 'name',
				'rules' => 'required'
		],
	];

	private $fillables = [
		'name',
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
		$this->load->model('author');
		$this->load->library('form_validation');
    }

    /**
	 * Create an author
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

		$author = Author::create($data);

		$this->response($author, 201);
    }
}
