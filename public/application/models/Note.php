<?php     
class Note extends CI_Model {

        public function __construct(){
                parent::__construct();
                $this->load->library('rb');
        }

        public static function get()
        {
            return R::findAll('notes');
        }

        public static function getOne($id)
        {
            return R::findOne('notes', 'id='.$id);
        }

        public static function create($data) 
        {
                $note = R::dispense('notes');

                $note->title = $data['title'];
                $note->content = $data['content'];

                $note_id = R::store($note);

                return $note;
        }

        public static function update($data, $id) 
        {
                $note = R::findOne('notes', 'id='.$id);

                $note->title = $data['title'];
                $note->content = $data['content'];

                $note_id = R::store($note);

                return $note;
        }

}