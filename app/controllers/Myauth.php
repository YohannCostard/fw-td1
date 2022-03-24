<?php
namespace controllers;
use models\User;
use Ubiquity\controllers\auth\AuthController;
use Ubiquity\controllers\auth\WithAuthTrait;
use Ubiquity\orm\DAO;
use Ubiquity\utils\http\UResponse;
use Ubiquity\utils\http\USession;
use Ubiquity\utils\http\URequest;
use controllers\auth\files\MyauthFiles;
use Ubiquity\controllers\auth\AuthFiles;
use Ubiquity\attributes\items\router\Route;

#[Route(path: "/login",inherited: true,automated: true)]
class Myauth extends \Ubiquity\controllers\auth\AuthController{

    use WithAuthTrait;
	protected function onConnect($connected) {
		$urlParts=$this->getOriginalURL();
		USession::set($this->_getUserSessionKey(), $connected);
		if(isset($urlParts)){
			$this->_forward(implode("/",$urlParts));
		}else{
			UResponse::header('Location','/');
		}
	}

	protected function _connect() {
		if(URequest::isPost()){
			$email=URequest::post($this->_getLoginInputName());
			$password=URequest::post($this->_getPasswordInputName());
			$user=DAO::getOne(User::class,'email= ?',false,[$email]);
            if($user!=null){
                USession::set('idOrga',$user->getOrganization());
            }
		}
		return $user;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::isValidUser()
	 */
	public function _isValidUser($action=null): bool {
		return USession::exists($this->_getUserSessionKey());
	}

	public function _getBaseRoute(): string {
		return '/login';
	}
	
	protected function getFiles(): AuthFiles{
		return new MyauthFiles();
	}

    public function _displayInfoAsString() {
        return true;
    }

    public function hasAccountCreation(): bool
    {
        return true;
    }


    protected function getAuthController(): AuthController
    {
        // TODO: Implement getAuthController() method.
    }
}
