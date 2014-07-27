public function loginWithLinkedin() {

        // get data from input
        $code = Input::get( 'code' );

        $linkedinService = OAuth::consumer( 'Linkedin' );


        if ( !empty( $code ) ) {

            // This was a callback request from linkedin, get the token
            $token = $linkedinService->requestAccessToken( $code );
            // Send a request with it. Please note that XML is the default format.
            $result = json_decode($linkedinService->request('/people/~?format=json'), true);

            // Show some of the resultant data
            echo 'Your linkedin first name is ' . $result['firstName'] . ' and your last name is ' . $result['lastName'];


            //Var_dump
            //display whole array().
            dd($result);

        }// if not ask for permission first
        else {
            // get linkedinService authorization
            $url = $linkedinService->getAuthorizationUri(array('state'=>'DCEEFWF45453sdffef424'));

            // return to linkedin login url
            return Redirect::to( (string)$url );
        }


    }
