<?php

/** 
 * This is a script to test the Jwt grant type
 */

require __DIR__ . '/../vendor/autoload.php';

use OAuth2\Encryption\Jwt;
/**
 * Generate a JWT
 *
 * @param $privateKey The private key to use to sign the token
 * @param $iss The issuer, usually the client_id
 * @param $sub The subject, usually a user_id
 * @param $aud The audience, usually the URI for the oauth server
 * @param $exp The expiration date. If the current time is greater than the exp, the JWT is invalid
 * @param $nbf The "not before" time. If the current time is less than the nbf, the JWT is invalid
 * @param $jti The "jwt token identifier", or nonce for this JWT
 *
 * @return string
 */
function generateJWT($privateKey, $iss, $sub, $aud, $exp = null, $nbf = null, $jti = null)
{
    if (!$exp) {
        $exp = time() + 1000;
    }

    $params = array(
        'iss' => $iss,
        'sub' => $sub,
        'aud' => $aud,
        'exp' => $exp,
        'iat' => time(),
    );

    if ($nbf) {
        $params['nbf'] = $nbf;
    }

    if ($jti) {
        $params['jti'] = $jti;
    }

    $jwtUtil = new Jwt();

    return $jwtUtil->encode($params, $privateKey, 'RS256');
}

$private_key = file_get_contents(__DIR__ . '/../media/key.pem');
$client_id   = 'client1';
$user_id     = 'user1';
$grant_type  = 'urn:ietf:params:oauth:grant-type:jwt-bearer';

$jwt = generateJWT($private_key, $client_id, $user_id, 'http://localhost:8083');

passthru("curl http://localhost:8083/oauth -d 'grant_type=$grant_type&assertion=$jwt'");



