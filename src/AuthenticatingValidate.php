<?php

namespace Gjpgwa\Authenticating;

use Illuminate\Support\Facades\Validator;

class AuthenticatingValidate {

    var $path;
    var $response_text;


    public function validator($path, $payload) {
        $this->path = $path;
        return $this->{$path}($payload);
    }

    private function _validate($payload, $rules, $messages) {
        $error = false;
        $validator = Validator::make($payload, $rules, $messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $all_errors = $errors->all();
            $message = implode(", ",$all_errors);
            $error = ['path'=>$this->path,'message'=>$message];
        }
        return $error;
    }

    private function getUser($payload) {
        $rules = [
            'accessCode' => 'required|numeric',
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.'
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function updateUser($payload) {
        $rules = [
            'accessCode' => 'required|numeric',
            'email' => 'nullable|email',
            'phone' => 'nullable|numeric',
            'firstName' => 'nullable|alpha',
            'lastName' => 'nullable|alpha',
            'address' => 'nullable|alpha_num',
            'city' => 'nullable',
            'state' => 'nullable',
            'street' => 'nullable',
            'province' => 'nullable|alpha|size:2',
            'buildingNumber' => 'nullable|alpha_num',
            'zipCode' => 'nullable|alpha_num',
            'month' => 'nullable|numeric',
            'day' => 'nullable|numeric',
            'year' => 'nullable|numeric',
            'ssn'   => 'nullable|numeric'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.',
            'email'    => 'The :attribute must be an email address.',
            'alpha'     => 'The :attribute must be letter characters.',
            'alpha_num' => 'The :attribute must be letters and numbers.',
            'alpha_dash' => 'The :attribute must be a Base64 encoded image.',
            'size'  => 'The :attribute must be exactly :size characters.',
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function authenticateProfile($payload) {
        $rules = [
            'accessCode' => 'required|numeric',
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.'
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function verifyPhone($payload) {
        $rules = [
            'accessCode' => 'required|numeric'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.'
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function verifyPhoneCode($payload) {
        $rules = [
            'accessCode' => 'required|numeric',
            'code' =>   'required|numeric'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.'
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function verifyEmail($payload) {
        $rules = [
            'accessCode' => 'required|numeric'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.'
        ];
        return $this->_validate($payload, $rules, $messages);
    }


    private function comparePhotos($payload) {
        $rules = [
            'accessCode' => 'required|numeric',
            'img1' => 'required|alpha_dash',
            'img2' => 'required|alpha_dash'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.',
            'alpha_dash' => 'The :attribute must be a Base64 encoded image.',
        ];
        return $this->_validate($payload, $rules, $messages);
    }


    private function uploadID($payload) {
        $rules = [
            'accessCode' => 'required|numeric',
            'idFront'   => 'required|alpha_dash',
            'idBack'   => 'required|alpha_dash',
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.',
            'alpha_dash' => 'The :attribute must be a Base64 encoded image.',
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function checkUploadID($payload) {
        $rules = [
            'accessCode' => 'required|numeric'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.'
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function getAvailableNetworks($payload) {
        $rules = [
            'accessCode' => 'required|numeric'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.'
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function verifySocialNetworks($payload) {
        $rules = [
            'accessCode' => 'required|numeric',
            'network'   => "required",
            'socialMediaAccessToken'   => "required",
            'socialMediaUserId'   => "required",
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.'
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function getQuiz($payload) {
        $rules = [
            'accessCode' => 'required|numeric'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.'
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function verifyQuiz($payload) {
        $rules = [
            'accessCode' => 'required|numeric',
            'quizId' => 'required|alpha_num',
            'transactionId' => 'required|alpha_num',
            'responseUniqueId' => 'required|alpha_num',
            'answers.*.questionId' => 'required|alpha_dash',
            'answers.*.choiceId' => 'required|alpha_num',
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.',
            'alpha_num' => 'The :attribute must be letters and numbers.',
            'alpha_dash' => 'The :attribute must be alpha_dash.'
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function generateCriminalReport($payload) {
        $rules = [
            'accessCode' => 'required|numeric'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.'
        ];
        return $this->_validate($payload, $rules, $messages);
    }


    private function createUser($payload) {
        $rules = [
            'companyId' => 'required|alpha_dash',
            'firstName' => 'required|alpha',
            'lastName' => 'required|alpha',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'country' => 'required|in:CAN,USA'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.',
            'email'    => 'The :attribute must be an email address.',
            'alpha'     => 'The :attribute must be letter characters.',
            'alpha_num' => 'The :attribute must be letters and numbers.',
            'alpha_dash' => 'The :attribute must be a company ID.',
            'size'  => 'The :attribute must be exactly :size characters.',
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function setAvailableNetworks($payload) {
        $rules = [
            'companyId' => 'required|alpha_dash',
            'networks.*'  => 'required|in:facebook,twitter,instagram'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.',
            'alpha_dash' => 'The :attribute must be a company ID.',
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function setContactRequired($payload) {
        $rules = [
            'companyId' => 'required|alpha_dash',
            'isPhoneRequired'  => 'required|boolean',
            'isEmailRequired'  => 'required|boolean'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.',
            'boolean' => 'The :attribute must true or false.',
            'alpha_dash' => 'The :attribute must be a company ID.',
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function setPhotoMatchPercent($payload) {
        $rules = [
            'companyId' => 'required|alpha_dash',
            'percent'  => 'required|numeric'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.',
            'alpha_dash' => 'The :attribute must be a company ID.',
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function setDaysToExpire($payload) {
        $rules = [
            'companyId' => 'required|alpha_dash',
            'days'  => 'required|numeric'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.',
            'alpha_dash' => 'The :attribute must be a company ID.',
        ];
        return $this->_validate($payload, $rules, $messages);
    }

    private function getTestResult($payload) {
        $rules = [
            'companyId' => 'required|alpha_dash',
            'accessCode'  => 'required|numeric'
        ];
        $messages = [
            'required'    => 'The :attribute is required.',
            'numeric'    => 'The :attribute must be a number.',
            'alpha_dash' => 'The :attribute must be a company ID.',
        ];
        return $this->_validate($payload, $rules, $messages);
    }
}