<?php     
class Note extends CI_Model {

        public function __construct(){
                parent::__construct();
                $this->load->library('rb');
        }

        public static function create($title, $content) 
        {
                $note = R::dispense('notes');

                $note->title = $title;
                $note->content = $content;

                $note_id = R::store($note);

                return $note;
        }

}