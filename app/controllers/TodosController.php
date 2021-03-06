<?php
namespace controllers;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\controllers\auth\AuthController;
use Ubiquity\controllers\auth\WithAuthTrait;
use Ubiquity\utils\http\URequest;
use Ubiquity\utils\http\USession;

/**
  * Controller TodosController
  */
class TodosController extends \controllers\ControllerBase{
    use WithAuthTrait;

    const CACHE_KEY = 'datas/lists/';
    const EMPTY_LIST_ID='not saved';
    const LIST_SESSION_KEY='list';
    const ACTIVE_LIST_SESSION_KEY='active-list';

    #[Route('_default')]
	public function index(){
        $list=USession::get(self::LIST_SESSION_KEY,[]);
        $this->displayList($list);
	}

    private function displayList($list){
        $this->loadview('main/displayList.html',compact("list"));
    }

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadView('main/vMenu.html');
    }

    #[Post(path: "Todos/add",name: "todos.addElement")]
	public function addElement(){
        $list=USession::get(self::ACTIVE_LIST_SESSION_KEY,[]);
        $newElement=URequest::post('elm');
        $list []=$newElement;
        USession::set(self::ACTIVE_LIST_SESSION_KEY,$list);
        $this->displayList($list);
	}


	#[Get(path: "Todos/delete/{index}",name: "todos.delete")]
	public function deleteElement($index){
        $list=USession::get(self::ACTIVE_LIST_SESSION_KEY,[]);
        unset($list[$index]);
        USession::set(self::ACTIVE_LIST_SESSION_KEY,$list=\array_values($list));
        $this->displayList($list);
	}

    protected function getAuthController(): AuthController
    {
        return new Login($this);
    }


    /*#[Post(path: "Todos/edit/{index}",name: "todos.edit")]
    public function editElement($index){

    }

    #[Get(path: "Todos/loadList/{uniqid}",name: "todos.loadList")]
    public function loadList($uniqid){
    }

    #[Post(path: "Todos/loadList/",name: "todos.loadListPost")]
    public function loadListFromForm(){
    }

    #[Get(path: "Todos/new/{force}",name: "todos.new")]
    public function newlist($force){
    }

    #[Get(path: "Todos/saveList/",name: "todos.save")]
    public function saveList(){
    }*/
}
