<?php
namespace controllers;
 use models\Product;
 use models\Section;
 use Ubiquity\attributes\items\router\Get;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\orm\DAO;
 use Ubiquity\utils\http\USession;

 /**
  * Controller StoreController
  */
class StoreController extends \controllers\ControllerBase{

    const LIST_SESSION_KEY='list';

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

    #[Get(path: "addpanier/{id}/{count}",name: "panier")]
    public function addpanier($id, $count){
        $list = USession::get(self::LIST_SESSION_KEY,[]);
        if(isset($list[$id])){
            $list[$id] = $list[$id] + $count;
        } else {
            $list[$id] = $count;
        }
        USession::set(self::LIST_SESSION_KEY,$list);
        $this->index();
    }

    public function initialize()
    {
        $count = 0;
        $list = USession::get(self::LIST_SESSION_KEY,[]);
        foreach ($list as $produit){
            $count = $count + $produit;
        }
        $this->view->setVar('panier', $list);
        $this->view->setVar('count', $count);
        parent::initialize();
    }
}
