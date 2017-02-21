<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Network\Http\Client;
use Cake\Utility\Hash;
use Cake\Core\Configure;

class UframeComponent extends Component
{
    public function initialize(array $config) {
        $this->client = [
          'host' => 'ooinet.oceanobservatories.org',
          'scheme' => 'https',          
          'auth' => [
            'username' => Configure::read('Uframe.username'), 
            'password' => Configure::read('Uframe.token')
          ]
        ];
    }

    public function cassandra_times($site,$node,$inst,$method,$stream) {
        $http = new Client($this->client);
        $response = $http->get('api/m2m/12576/sensor/inv/' . $site . '/' . $node . '/' . $inst . '/metadata/times?partition=true');        
        $response = json_decode($response->body);
        $response = array_filter($response, function($element) use ($method, $stream) {
          if (isset($element->method) && isset($element->stream)) {
            return (($element->method == $method) && ($element->stream == $stream));
          } else {
            return false;          
          }
        });
        return $response;
    }

}