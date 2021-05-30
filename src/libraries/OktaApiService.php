<?php
namespace Marigold\Domain\SharedKernel;
 
class OktaApiService
{
    private $clientId;
    private $clientSecret;
    private $redirectUri;
    private $metadataUrl;

    public function __construct()
    {

        $this->clientId     = $_ENV['OKTA_CLIENT_ID'] ?? $_SERVER['OKTA_CLIENT_ID'] ??  getenv('OKTA_CLIENT_ID')  ?? NULL;
        $this->clientSecret =  $_ENV['OKTA_CLIENT_SECRET'] ?? $_SERVER['OKTA_CLIENT_SECRET'] ??  getenv('OKTA_CLIENT_SECRET')  ?? NULL;
        $this->redirectUri  =  $_ENV['OKTA_REDIRECT_URI'] ?? $_SERVER['OKTA_REDIRECT_URI'] ??  getenv('OKTA_REDIRECT_URI')  ?? NULL;
        $this->metadataUrl  =  $_ENV['OKTA_METADATA_URL'] ?? $_SERVER['OKTA_METADATA_URL'] ??  getenv('OKTA_METADATA_URL')  ?? NULL;
    }

    public function buildAuthorizeUrl($state)
    {
        $metadata = $this->httpRequest($this->metadataUrl);
        $url = $metadata->authorization_endpoint . '?' . http_build_query([
            'response_type' => 'code',
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
            'state' => $state,
            'scope' => 'openid email'
        ]);

        return $url;
    }

    public function authorizeUser($state)
    {
        if ($state != $_GET['state']) {
            $result['error'] = true;
            $result['errorMessage'] = 'Authorization server returned an invalid state parameter';
            return $result;
        }

        if (isset($_GET['error'])) {
            $result['error'] = true;
            $result['errorMessage'] = 'Authorization server returned an error: '.htmlspecialchars($_GET['error']);
            return $result;
        }

        $metadata = $this->httpRequest($this->metadataUrl);

        $response = $this->httpRequest($metadata->token_endpoint, [
            'grant_type' => 'authorization_code',
            'code' => $_GET['code'],
            'redirect_uri' => $this->redirectUri,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret
        ]);

        if (! isset($response->id_token)) {
            $result['error'] = true;
            $result['errorMessage'] = 'Error fetching ID token!';
            return $result;
        }

        $claims = json_decode(base64_decode(explode('.', $response->id_token)[1]));

        $result['username'] = $claims->email;
        $result['success'] = true;
        return $result;
    }

    private function httpRequest($url, $params = null)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($params) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }
        return json_decode(curl_exec($ch));
    }
}