<?php

namespace Gwagjp\Authenticating;

class AuthenticatingResponse {

    public function processResponse($responseType,$response) {
        if(!isset($response)) {
            return response()->json(['error'=>['data'=>[],'message'=>'No response received']],400);
        }  else if(is_array($response)) {
            return response()->json($response,400);
        } else {
            if (!is_string($response)) {
                $response = (string) $response->getBody();
            }
            return $this->{$responseType}($response);
        }
    }

    private function processSimpleResponseObject($response) {
        $response = json_decode($response);
        if(isset($response->hasError) && $response->hasError == true)
            return response()->json(["error" => ['data'=>$response, 'message'=>$response->error->errorMessage]],$response->code);
        else if(isset($response->hasError) && $response->hasError == false)
            return response()->json(["success" => ['data'=>$response->data,'message'=>'Request processed successfully']],$response->code);
        else if(isset($response->error) && $response->error == true)
            return response()->json(["error" => ['data'=>$response, 'message'=>'Error']],$response->code);
        else if(isset($response->error) && $response->error == false)
            return response()->json(["success" => ['data'=>$response, 'message'=>'Request successful']],$response->code);
    }

    private function processUserHeaderObject($response) {
        $response = json_decode($response);
        if(isset($response->hasError) && $response->hasError == 'true') {
            if(isset($response->error->errorMessage))
                return response()->json(["error" => ['response'=>$response, 'message'=>$response->error->errorMessage]],$response->code);
            else
                return response()->json(["error" => ['response'=>$response, 'message'=>'User process failed']],$response->code);
        }
        else if($response->data->accessCode)
            return response()->json(["success" => ['response'=>$response,'message'=>'User processed successfully']],$response->code);
        else
            return response()->json(["error" => ['response'=>$response, 'message'=>'Unknown response']],$response->code);
    }


    private function processCheckPhotoResultsObject($response) {
        $response = json_decode($response);
        if(isset($response->hasError) && $response->hasError == 'true')
            return response()->json(["error" => ['response'=>$response, 'message'=>'Request failed']],$response->code);
        else if(isset($response->hasError) && $response->hasError == 'false')
            return response()->json(["success" => ['response'=>$response, 'message'=>$response->data->description]],$response->code);
        else
            return response()->json(["error" => ['response'=>$response, 'message'=>'Unknown response']],$response->code);
    }

    private function processAvailableNetworksHeader($response) {
        $response = json_decode($response);
        if(isset($response->hasError))
            return $this->processSimpleResponseObject($response);
        else if(isset($response->error) && $response->error == 'true')
            return response()->json(["error" => ['response'=>$response, 'message'=>'Request failed']],$response->code);
        else if(isset($response->data->identityProof->description))
            return response()->json(["success" => ['response'=>$response, 'message'=>$response->data->identityProof->description]],$response->code);
        else
            return response()->json(["error" => ['response'=>$response, 'message'=>'Unknown response']],$response->code);
    }

    private function processTestResultObject($response) {
        $response = json_decode($response);
        if(isset($response->hasError))
            return $this->processSimpleResponseObject($response);
        else if(isset($response->error) && $response->error == 'true')
            return response()->json(["error" => ['response'=>$response, 'message'=>'Request failed']],$response->code);
        else if(isset($response->data->identityProof->description))
            return response()->json(["success" => ['response'=>$response, 'message'=>$response->data->identityProof->description]],$response->code);
        else
            return response()->json(["error" => ['response'=>$response, 'message'=>'Unknown response']],$response->code);
    }

}