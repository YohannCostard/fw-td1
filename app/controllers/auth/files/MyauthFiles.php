<?php
namespace controllers\auth\files;

use Ubiquity\controllers\auth\AuthFiles;
 /**
  * Class MyauthFiles
  */
class MyauthFiles extends AuthFiles{
	public function getViewIndex(): string{
		return "Myauth/index.html";
	}

	public function getViewInfo(): string{
		return "Myauth/info.html";
	}

	public function getViewNoAccess(): string{
		return "Myauth/noAccess.html";
	}

	public function getViewDisconnected(): string{
		return "Myauth/disconnected.html";
	}

	public function getViewMessage(): string{
		return "Myauth/message.html";
	}

	public function getViewCreate(): string{
		return "Myauth/create.html";
	}

	public function getViewStepTwo(): string{
		return "Myauth/stepTwo.html";
	}

	public function getViewBadTwoFACode(): string{
		return "Myauth/badTwoFACode.html";
	}

	public function getViewBaseTemplate(): string{
		return "Myauth/baseTemplate.html";
	}

	public function getViewInitRecovery(): string{
		return "Myauth/initRecovery.html";
	}

	public function getViewRecovery(): string{
		return "Myauth/recovery.html";
	}


}
