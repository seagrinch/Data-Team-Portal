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

    public function cassandra_times($reference_designator,$method,$stream) {
        $site = substr($reference_designator,0,8);
        $node = substr($reference_designator,9,5);
        $inst = substr($reference_designator,15,12);
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

    public function recent_data($reference_designator,$method,$stream) {
        $site = substr($reference_designator,0,8);
        $node = substr($reference_designator,9,5);
        $inst = substr($reference_designator,15,12);
/*
        if (strncmp($site, 'RS',2)==0) {
          $method = 'streamed';
        } elseif (in_array($site,['CE02SHBP','CE04OSBP'])) {
          $method = 'streamed';
        } else {
          $method = 'telemetered';          
        }
*/
        $start_date = date('Y-m-d\TH:i:s.0\Z',time()-(24*60*60));
        $end_date = date('Y-m-d\TH:i:s.0\Z',time());
        $url = '/api/m2m/12576/sensor/inv/' . $site . '/' . $node . '/' . $inst . '/' . $method . '/' . $stream . '?beginDT=' . $start_date . '&endDT=' . $end_date . '&limit=1000';  // '&parameters=7,' . $parameter

        $http = new Client($this->client);
        $response = $http->get($url);        
        $response = json_decode($response->body);
        return $response;
    }

}
