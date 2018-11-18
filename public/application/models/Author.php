<?php     
class Author extends CI_Model {

        public function __construct(){
            parent::__construct();
            $this->load->library('rb');
        }

        public static function getAuthor($author) 
        {
            return R::findOne('authors', 'id='.$author);
        }

        public static function create($data) 
        {
            $author = R::dispense('authors');

            $author->name = $data['name'];
            $author->ownNoteList = [];

            R::store($author);

            return $author;
        }

        public static function setNote($note, $author) 
        {
            $author = Author::getAuthor($author);

            $author->ownNoteList[] = $note;

            R::store($author);
        }

        public static function getOwnNotes($author) 
        {
            $author = Author::getAuthor($author);

            return $author->ownNoteList;
            
        }

}