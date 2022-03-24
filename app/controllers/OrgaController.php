<?php
namespace controllers;
 use models\Organization;
 use Ubiquity\attributes\items\router\Get;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\orm\DAO;
 use Ubiquity\orm\repositories\ViewRepository;

 /**
  * Controller OrgaController
  */
class OrgaController extends ControllerBase{
    private ViewRepository $repo;

    public function initialize() {
        parent::initialize();
        $this->repo??=new ViewRepository($this,Organization::class);

    }

    #[Get (name: "orga.index")]
	public function index(){
        $orgas=DAO::getAll(Organization::class);
        $this->loadView("OrgaController/index.html", compact('orgas'));

	}

    #[Route(path: "getOne/{idOrga}",name: "orga.getOne")]
    public function getOne($idOrga){

        $orga=DAO::getById(Organization::class,$idOrga);
        $this->loadView("OrgaController/getOne.html", compact('orga'));
    }
}
