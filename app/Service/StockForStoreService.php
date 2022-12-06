<?php
namespace App\Service;

use App\Traits\ConsumeExternalService;
// ojo usar esata parta para actualizar productos de woocommerce 
class StockForStoreService 
{
     use ConsumeExternalService;
     public $baseUri;
     public $secret;

     public function __construct()
     {
         $this->baseUri = config('services.oasis.base_uri');
         $this->secret = config('services.oasis.secret');
     }

     public function getStockIndex()
     {
         error_log($this->secret);
       return  $this->performRequest('GET', '/stockService');
       
     }

     public function createStock($data, $formaParams=[])
     {
       
      return  $this->performRequest('POST', '/stockService', $data, $formaParams);
     }
     public function getStockShow($Stock_id)
     {
        return $this->performRequest('GET', "/stockService/{$Stock_id}");
     }

     public function editStock($data, $Stock_id)
     {
      return $this->performRequest('PUT', "/stockService/{$Stock_id}", $data);
     }
     public function deleteStock($Stock_id)
     {
      return $this->performRequest('DELETE', "/stockService/{$Stock_id}");
     }
}

