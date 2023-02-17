<?php

require_once 'SessionController.php';
require_once __DIR__.'/../repository/BandRepository.php';
class BandsController extends SessionController
{
    private $bandRepository;

    public function __construct()
    {
        parent::__construct();
        $this->bandRepository = new BandRepository();
    }

    public function homePage(){
        $this->requiredSession();
        $bands=$this->bandRepository->allBandsGet();
        $this->render('homePage',['bands'=>$bands]);
    }
}