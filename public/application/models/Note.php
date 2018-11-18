<?php     
class Note extends CI_Model {

        public function __construct(){
                parent::__construct();
                $this->load->library('rb');
        }

        public static function create($data) 
        {
                $note = R::dispense('notes');

                $note->title = $data['title'];
                $note->content = $data['content'];

                $note_id = R::store($note);

                return $note;
        }

}