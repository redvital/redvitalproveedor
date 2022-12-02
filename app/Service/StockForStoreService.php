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
         $this->baseUri = config('services.stock.base_uri');
         $this->secret = config('services.stock.secret');
     }

     public function getStockIndex()
     {
         error_log($this->secret);
       return  $this->performRequest('GET', '/stockService');
       
     }

     public function createStock($data)
     {
       
      return  $this->performRequest('POST', '/stockService', $data);
     }
     public function getStockShow($stockService)
     {
        return $this->performRequest('GET', "/stockService/{$stockService}");
     }

     public function editStock($data, $stockService)
     {
      return $this->performRequest('PUT', "/stockService/{$stockService}", $data);
     }
     public function deleteStock($stockService)
     {
      return $this->performRequest('DELETE', "/stockService/{$stockService}");
     }
}

