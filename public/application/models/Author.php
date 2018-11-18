<?php     
class Author extends CI_Model {

        public function __construct(){
                parent::__construct();
                $this->load->library('rb');
        }

        public static function create($data) 
        {
                $author = R::dispense('authors');

                $author->name = $data['name'];

                R::store($author);

                return $author;
        }

}