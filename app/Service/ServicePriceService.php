<?php
namespace App\Service;

use App\Traits\ConsumeExternalService;
// ojo usar esata parta para actualizar productos de woocommerce 
class PriceService 
{
     use ConsumeExternalService;
     public $baseUri;
     public $secret;

     public function __construct()
     {
         $this->baseUri = config('services.price.base_uri');
         $this->secret = config('services.price.secret');
     }

     public function getPrice()
     {
         
       return  $this->performRequest('GET', '/price');
       
     }

     public function createPrice($data)
     {
       
      return  $this->performRequest('POST', '/price', $data);
     }
     public function getAuthor($price)
     {
        return $this->performRequest('GET', "/price/{$price}");
     }

     public function editAuthor($data, $price)
     {
      return $this->performRequest('PUT', "/price/{$price}", $data);
     }
     public function deleteAuthor($price)
     {
      return $this->performRequest('DELETE', "/price/{$price}");
     }
}

