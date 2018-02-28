<?php

namespace Gwagjp\Authenticating;


class authenticatingFaker {

    public function __construct() {

    }

    /*
     * getUser
     */

    public function getUser($payload) {
        return <<<EOR
{
    "hasError": false,
    "code": 200,
    "data": {
        "firstName": "Pat",
        "lastName": "M",
        "companyId": "7717b830-2b94-464f-86f6-952225a9aba2",
        "userId": "1b53f070-bc1e-4d42-bb64-0f0172b9a801",
        "accessCode": "248099",
        "expirationDate": "4/5/2063 6:06:44 PM"
    }
}
EOR;
    }

    public function getUserError($payload) {
        return <<<EOR
{
    "hasError": true,
    "code": 400,
    "error": {
        "errorMessage": "Error message"
    }
}
EOR;
    }

    /*
     * updateUser
     */

    public function updateUser($payload) {
        return <<<EOR
{
    "hasError": false,
    "code": 200,
    "data": {
        "firstName": "Pat",
        "lastName": "M",
        "companyId": "7717b830-2b94-464f-86f6-952225a9aba2",
        "userId": "1b53f070-bc1e-4d42-bb64-0f0172b9a801",
        "accessCode": "248099",
        "expirationDate": "4/5/2063 6:06:44 PM"
    }
}
EOR;
    }

    public function updateUserError($payload) {
        return <<<EOR
{
    "hasError": true,
    "code": 400,
    "error": {
        "errorMessage": "Error message"
    }
}
EOR;
    }

    /*
     * authenticateUser
     */

    public function AuthenticateProfile($payload) {
        return <<<EOR
{
    "hasError": false,
    "code": 200,
    "data": {
        "successful" : true
    }
}
EOR;
    }

    public function AuthenticateProfileError($payload) {
        return <<<EOR
{
    "hasError": true,
    "code": 400,
    "error": {
        "errorMessage": "Error message"
    }
}
EOR;
    }

    /*
    * verifyPhone
    */

    public function VerifyPhone($payload) {
        return <<<EOR
{
    "hasError": false,
    "code": 200,
    "data": {
        "successful" : true
    }
}
EOR;
    }

    public function VerifyPhoneError($payload) {
        return <<<EOR
{
    "hasError": true,
    "code": 400,
    "error": {
        "errorMessage": "Error message"
    }
}
EOR;
    }

    /*
    * verifyPhoneCode
    */

    public function VerifyPhoneCode($payload) {
        return <<<EOR
{
    "hasError": false,
    "code": 200,
    "data": {
        "successful" : true
    }
}
EOR;
    }

    public function VerifyPhoneCodeError($payload) {
        return <<<EOR
{
    "hasError": true,
    "code": 400,
    "error": {
        "errorMessage": "Error message"
    }
}
EOR;
    }

    /*
    * uploadID
    */

    public function UploadID($payload) {
        return <<<EOR
{
    "hasError": false,
    "code": 200,
    "data": {
        "successful" : true
    }
}
EOR;
    }

    public function UploadIDError($payload) {
        return <<<EOR
{
    "hasError": true,
    "code": 400,
    "error": {
        "errorMessage": "Error message"
    }
}
EOR;
    }

    /*
    * checkUploadID
    */

    public function CheckUploadID($payload) {
        return <<<EOR
{
    "hasError": false,
    "code": 200,
    "data": {
        "result": "parsing_failed",
        "numAttemptsLeft": 1,
        "description": "Unable to detect the image. This can be cause by poor quality photos, bad lighting, glares, or other things that interfere with the image. Please try again and make sure that the id is on a consted surface (IE, a white ID on a black background or a black id on a white background)."
    }
}
EOR;
    }

    public function CheckUploadIDError($payload) {
        return <<<EOR
{
    "hasError": true,
    "code": 400,
    "error": {
        "errorMessage": "Error message"
    }
}
EOR;
    }

    /*
* createUser
*/

    public function CreateUser($payload) {
        return <<<EOR
{
    "hasError": false,
    "code": 200,
    "data": {
        "firstName": "Pat",
        "lastName": "M",
        "companyId": "7717b830-2b94-464f-86f6-952225a9aba2",
        "userId": "1b53f070-bc1e-4d42-bb64-0f0172b9a801",
        "accessCode": "248099",
        "expirationDate": "4/5/2063 6:06:44 PM"
    }
}
EOR;
    }

    public function CreateUserError($payload) {
        return <<<EOR
{
    "hasError": true,
    "code": 400,
    "error": {
        "errorMessage": "Error message"
    }
}
EOR;
    }
} 