<?php
namespace controllers;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\utils\http\USession;

/**
  * Controller TodosController
  */
class TodosController extends \controllers\ControllerBase{


    const CACHE_KEY = 'datas/lists/';
    const EMPTY_LIST_ID='not saved';
    const LIST_SESSION_KEY='list';
    const ACTIVE_LIST_SESSION_KEY='active-list';

    #[Route('_default')]
	public function index(){
        $list=USession::set(self::ACTIVE_LIST_SESSION_KEY,[]);
        $this->displayList($list);
	}

    private function displayList($list){
        $this->loadView("main/displayList.html");
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadView("main/vMenu.html");
    }

   /* #[Post(path: "Todos/add",name: "todos.addElement")]
	public function addElement(){
		
	}


	#[Get(path: "Todos/delete/{index}",name: "todos.delete")]
	public function deleteElement($index){
		
	}


	#[Post(path: "Todos/edit/{index}",name: "todos.edit")]
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
