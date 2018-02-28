<?php

namespace Gwagjp\Authenticating;

use GuzzleHttp\Client;
use Gwagjp\Authenticating\AuthenticatingValidate;

class AuthenticatingClient
{
    const API_URL = "https://api.authenticating.com/api/v1";

    protected $client;
    protected $headers;
    protected $userAuthKey;
    protected $additionalParams;
    protected $testMode;
    protected $faker = '';

    /**
     * @var bool
     */
    public $requestAsync = false;

    /**
     * @var Callable
     */
    private $requestCallback;

    /**
     * Turn on, turn off async requests
     *
     * @param bool $on
     * @return $this
     */
    public function async($on = true)
    {
        $this->requestAsync = $on;
        return $this;
    }

    /**
     * Callback to execute after Authenticating returns the response
     * @param Callable $requestCallback
     * @return $this
     */
    public function callback(Callable $requestCallback)
    {
        $this->requestCallback = $requestCallback;
        return $this;
    }

    public function __construct($userAuthKey,$testMode)
    {
        $this->client = new Client(['http_errors' => false]);
        $this->userAuthKey = $userAuthKey;
        $this->testMode = $testMode;
        $this->headers = ['headers' => []];
        $this->additionalParams = [];
    }

    public function testCredentials() {
        return "authKey: ".$this->userAuthKey;
    }

    private function requiresAuth() {
        $this->headers['headers']['authKey'] = $this->userAuthKey;
    }

    private function usesJSON() {
        $this->headers['headers']['Content-Type'] = 'application/json';
    }

    public function addParams($params = [])
    {
        $this->additionalParams = $params;

        return $this;
    }

    public function setParam($key, $value)
    {
        $this->additionalParams[$key] = $value;

        return $this;
    }

    public function sendAuthenticating($accessCode, $path, $method = "post", $payload = []) {

        if(isset($accessCode)) {
            $payload['accessCode'] = $accessCode;
            if($accessCode == 666666)
                $this->faker = 'Error';

        }
        else
            $payload['accessCode'] = NULL;

        if(count($payload)>0) {
            $validate = new AuthenticatingValidate;
            $error_response = $validate->validator($path,$payload);
            if(isset($error_response) && is_array($error_response)) {
                return ["error" => ['data'=>$error_response['path'],'message'=>$error_response['message']]];
            }
        }

        $params = array(
            'path' => $path,
            'payload' => $payload,
            'method' => $method
        );

        return $this->_sendAuthenticatingRequest($params);
    }

    /**
     * @param array $parameters
     * @return mixed
     */
    private function _sendAuthenticatingRequest($parameters = []){
        if($this->testMode) {
            \Log::info('fake Response........');
            $authenticatingFaker = new authenticatingFaker;
            return $authenticatingFaker->{$parameters['path'].$this->faker}($parameters['payload']);
        }
        \Log::info('AUTHENTICATING Response........');
        $this->requiresAuth();
        $this->usesJSON();

        $parameters = array_merge($parameters, $this->additionalParams);

        $this->headers['body'] = json_encode($parameters['payload']);
        $this->headers['headers']['verify'] = false;
        return $this->{$parameters['method']}($parameters['path']);
    }

    public function get($endPoint) {
        \Log::info(['authenticating'=>self::API_URL . '/'  . $endPoint, $this->headers]);
        if($this->requestAsync === true) {
            $promise = $this->client->getAsync(self::API_URL . '/' . $endPoint, $this->headers);
            return (is_callable($this->requestCallback) ? $promise->then($this->requestCallback) : $promise);
        }
        return $this->client->get(self::API_URL . '/'  . $endPoint, $this->headers);
    }

    public function post($endPoint) {
        \Log::info(['authenticating'=>self::API_URL . '/'  . $endPoint, $this->headers]);
        if($this->requestAsync === true) {
            $promise = $this->client->postAsync(self::API_URL . '/' .  $endPoint, $this->headers);
            return (is_callable($this->requestCallback) ? $promise->then($this->requestCallback) : $promise);
        }
        $response = $this->client->post(self::API_URL . '/'  . $endPoint, $this->headers);
        \Log::info([(string) $response->getBody()]);
        return $response;
    }

    public function put($endPoint) {
        \Log::info(['authenticating'=>self::API_URL . '/'  . $endPoint, $this->headers]);
        if($this->requestAsync === true) {
            $promise = $this->client->putAsync(self::API_URL . '/' .  $endPoint, $this->headers);
            return (is_callable($this->requestCallback) ? $promise->then($this->requestCallback) : $promise);
        }
        return $this->client->put(self::API_URL . '/'  . $endPoint, $this->headers);
    }
}
