<?php
namespace controllers;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\controllers\auth\AuthController;

 /**
  * Controller MainController
  */
class MainController extends \controllers\ControllerBase{

    #[Route('_default','home')]
	public function index(){
		$this->loadView("MainController/index.html");
	}

    protected function getAuthController(): AuthController{
        return new MyAuth($this);
    }
}
