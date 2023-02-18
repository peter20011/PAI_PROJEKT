<?php

require_once 'SessionController.php';
require_once __DIR__.'/../repository/BandRepository.php';
require_once __DIR__.'/../exceptions/NoMatchingRecordException.php';
require_once __DIR__.'/../exceptions/WorngParamertException.php';
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

            if(is_integer($id)){
                $this->changeHeader('logout');
            }
                try{
                    $band=$this->bandRepository->getBandById($id);
                }catch (NoMatchingRecordException | WorngParamertException $e ){
                    $this->changeHeader('logout');
                }
                return $this->render('bandProfile',['band'=>$band]);

            }

         $this->changeHeader('logout');
    }

    public function like(int $id){
        $this->bandRepository->like($id);
        http_response_code(200);
    }




}