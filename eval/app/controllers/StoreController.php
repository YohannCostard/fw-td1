<?php
namespace controllers;
 use models\Product;
 use models\Section;
 use Ubiquity\orm\DAO;

 /**
  * Controller StoreController
  */
class StoreController extends \controllers\ControllerBase{

    #[Route('_default', name: 'home')]
	public function index(){
        $Section=DAO::getAll(Section::class);
        $this->loadView('main/StoreController.html',compact("Section");
	}
}
