<?php

require_once 'SessionController.php';
require_once __DIR__.'/../repository/BandRepository.php';
class BBController extends SessionController
{

    private $bandRepository;

    public function __construct()
    {
        $this->bandRepository = new BandRepository();
    }


    //TODO
    public function bandProfile(){
        //$this->requiredSession();
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $band=$this->bandRepository->getBandById($id);
            return $this->render('bandProfile',['band'=>$band]);
        }

        $this->changeHeader('bandProfile');
    }




}