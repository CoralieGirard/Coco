<?php
    include "CommentairesTDG.php";
    include __DIR__ . "/../USER/User.php";
    date_default_timezone_set("America/New_York");

    class Commentaires{

        private $idCommentaire;
        private $idType;
        private $Type;
        private $DateCreation;
        private $Contenu;
        private $Proprietaire;
        private $likes;

        //getters
        public function getIdCommentaire(){
            return $this->idCommentaire;
        }

        public function getIdType(){
            return $this->idType;
        }

        public function getType(){
            return $this->Type;
        }

        public function getDateCreation(){
            return $this->DateCreation;
        }

        public function getContenu(){
            return $this->Contenu;
        }

        public function getProprietaire(){
            return $this->Proprietaire;
        }

        public function getLikes(){
            return $this->likes;
        }

        //setters
        public function setIdCommentaire($idCommentaire){
            $this->idCommenaire = $idCommentaire;
        }

        public function setIdType($idType){
            $this->idType = $idType;
        }

        public function setType($Type){
            $this->Type = $Type;
        }

        public function setDateCreation($dateCreation){
            $this->DateCreation = $dateCreation;
        }

        public function setContenu($contenu){
            $this->Contenu = $contenu;
        }

        public function setProprietaire($Proprietaire){
            $this->Proprietaire = $Proprietaire;
        }

        public function setLikes($likes){
            $this->likes = $likes;
        }

        //QOL
        public function addCommentaire($idType, $Type, $contenu, $Proprietaire){
            $dateCreation = date("Y-m-d H:i:s");
            $TDG = commentaireTDG::getInstance();
            $res = $TDG->addCommentaire($idType, $Type, $dateCreation, $contenu, $Proprietaire);
            $TDG = null;
            return $res;
        }

        public function update(){
            $TDG = commentaireTDG::getInstance();
            $res = $TDG->editCommentaire($this->Contenu, $this->idCommentaire);
            $TDG = null;
            return $res;

        }

        public function delete(){
            $TDG = commentaireTDG::getInstance();
            $res = $TDG->deleteCommentaire($this->idCommentaire);
            $TDG = null;
            return $res;
        }

        public function display(){
            $idCommentaire = $this->idCommentaire;
            $idType = $this->idType;
            $Type = $this->Type;
            $DateCreation = $this->DateCreation;
            $Contenu = $this->Contenu;
            $Proprietaire = $this->Proprietaire;
            $auteur = User::getById($Proprietaire);
            include "HTML/commentairetemplate.php";
        }

        public function loadCommentaire($idCommentaire){
            $TDG = commentaireTDG::getInstance();
            $res = $TDG->getByIdCommentaire($idCommentaire);

            $TDG = null;
            $this->setIdCommentaire($res["idCommentaire"]);
            $this->setProprietaire($res["Proprietaire"]);
            $this->setIdType($res["idType"]);
            $this->setType($res["Type"]);
            $this->setDateCreation(($res["DateCreation"]));
            $this->setContenu($res["Contenu"]);

            return $res;
        }

        public function nbLikes()
        {
            return CommentaireTDG::getInstance().getLikes();
        }


        /*
          static function used to create a list of posts
        */
        private static function fetchCommentaireByType($idType, $Type){
            $TDG = commentaireTDG::getInstance();
            $res = $TDG->getByIdType($idType, $Type);
            $TDG = null;
            return $res;
        }

        public static function createCommentaireList($idType, $type){

            $infoArray=Commentaires::fetchCommentaireByType($idType, $type);
            $commentaireList = array();

            foreach($infoArray as $ia){
                $tempCommentaire = new Commentaires();
                $tempCommentaire->setIdCommentaire($ia["idCommentaire"]);
                $tempCommentaire->setProprietaire($ia["Proprietaire"]);
                $tempCommentaire->setIdType($ia["idType"]);
                $tempCommentaire->setType($ia["Type"]);
                $tempCommentaire->setDateCreation($ia["DateCreation"]);
                $tempCommentaire->setContenu($ia["Contenu"]);
                array_push($commentaireList, $tempCommentaire);
            }

            return $commentaireList;
        }


    }

?>
