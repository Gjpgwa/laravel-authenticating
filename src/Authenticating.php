<?php

namespace Gwagjp\Authenticating;

use Gwagjp\Authenticating\AuthenticatingClient;
use Config;

class Authenticating {

    var $authenticatingClient;
    var $authenticatingResponse;

    public function __construct() {
        $authenticatingConfig = Config::get('authenticating');
        $this->authenticatingClient = new  AuthenticatingClient($authenticatingConfig['authKey'],$authenticatingConfig['testResponseData']);
        $this->authenticatingResponse = new  AuthenticatingResponse;
    }

    public function GetUser($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'getUser','post', $data);
        return $this->authenticatingResponse->processResponse('processUserHeaderObject',$response);
    }

    public function UpdateUser($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'updateUser','post', $data);
        return $this->authenticatingResponse->processResponse('processUserHeaderObject',$response);
    }

    public function AuthenticateUser($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'authenticateProfile','post', $data);
        return $this->authenticatingResponse->processResponse('processSimpleResponseObject',$response);
    }

    public function VerifyPhone($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'verifyPhone','post', $data);
        return $this->authenticatingResponse->processResponse('processSimpleResponseObject',$response);
    }

    public function VerifyPhoneCode($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'verifyPhoneCode','post', $data);
        return $this->authenticatingResponse->processResponse('processSimpleResponseObject',$response);
    }

    public function VerifyEmail($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'verifyEmail','post', $data);
        return $this->authenticatingResponse->processResponse('processSimpleResponseObject',$response);
    }

    public function ComparePhotos($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'comparePhotos','post', $data);
        return $this->authenticatingResponse->processResponse('processSimpleResponseObject',$response);
    }

    public function UploadID($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'uploadID','post', $data);
        return $this->authenticatingResponse->processResponse('processSimpleResponseObject',$response);
    }

    public function CheckUploadID($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'checkUploadID','post', $data);
        return $this->authenticatingResponse->processResponse('processCheckPhotoResultsObject',$response);
    }

    public function GetAvailableNetworks($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'getAvailableNetworks','post', $data);
        return $this->authenticatingResponse->processResponse('processSimpleResponseObject',$response);
    }

    public function VerifySocialNetworks($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'verifySocialNetworks','post', $data);
        return $this->authenticatingResponse->processResponse('processSimpleResponseObject',$response);
    }

    public function GetIdentityProofQuiz($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'getQuiz','post', $data);
        return $this->authenticatingResponse->processResponse('processQuizObjectHeader',$response);
    }

    public function VerifyQuiz($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'verifyQuiz','post', $data);
        return $this->authenticatingResponse->processResponse('processSimpleResponseObject',$response);
    }

    public function GenerateCriminalBackgroundReport($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'generateCriminalReport','post', $data);
        return $this->authenticatingResponse->processResponse('processSimpleResponseObject',$response);
    }

    public function CreateUser($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'createUser','post', $data);
        return $this->authenticatingResponse->processResponse('processUserHeaderObject',$response);
    }

    public function SetSocialNetworks($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'setAvailableNetworks','post', $data);
        return $this->authenticatingResponse->processResponse('processSimpleResponseObject',$response);
    }

    public function SetContactRequired($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'setContactRequired','post', $data);
        return $this->authenticatingResponse->processResponse('processSimpleResponseObject',$response);
    }

    public function SetMinimumPhotoPercent($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'setPhotoMatchPercent','post', $data);
        return $this->authenticatingResponse->processResponse('processSimpleResponseObject',$response);
    }

    public function SetDaysToExpire($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'setDaysToExpire','post', $data);
        return $this->authenticatingResponse->processResponse('processSimpleResponseObject',$response);
    }

    public function GetTestResult($accessCode, $data = []) {
        $response = $this->authenticatingClient->sendAuthenticating($accessCode,'getTestResult','post', $data);
        return $this->authenticatingResponse->processResponse('processTestResultObject',$response);
    }
}