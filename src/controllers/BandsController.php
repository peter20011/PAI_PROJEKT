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

    public function search(){
        $this->requiredSession();
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->bandRepository->getBandByName($decoded['search']));
        }
    }

}