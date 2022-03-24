<?php
namespace controllers;
 use models\Product;
 use models\Section;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\orm\DAO;

 /**
  * Controller StoreController
  */
class StoreController extends \controllers\ControllerBase{

    #[Route('_default', name: 'home')]
	public function index(){
        $Section=DAO::getAll(Section::class);
        $this->loadView('main/StoreController.html',compact("Section"));
	}

    #[Route(path: "Store/section/{id}",name: "section")]
    public function section($id){
        $Section=DAO::getById(Section::class,$id+1);
        $Product=$Section->getProducts();
        $this->loadView('main/Produits.html',compact("Section","Product"));
    }

    #[Route(path: "Store/allproducts",name: "products")]
    public function products(){
        $Product=DAO::getAll(Product::class);
        $this->loadView('main/Produits.html',compact("Product"));
    }

}
