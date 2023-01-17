<?php

namespace App\Service;

use App\Traits\ConsumeExternalService;
// informacion de woocommerce a OASIS
class PurchaseOrderService
{
  use ConsumeExternalService;
  public $baseUri;
  public $secret;

  public function __construct()
  {
    $this->baseUri = config('services.PurcheseOrden.base_uri');
    $this->secret = config('services.PurcheseOrden.secret');
  }

  public function getPurcheseOrden()
  {

    return  $this->performRequest('GET', '/orden');
  }

  public function createPurcheseOrden($data)
  {

    return  $this->performRequest('POST', '/orden', $data);
  }
  public function getAuthor($orden)
  {
    return $this->performRequest('GET', "/orden/{$orden}");
  }

  public function editPurcheseOrden($data, $orden)
  {
    return $this->performRequest('PUT', "/orden/{$orden}", $data);
  }
  public function deletePurcheseOrden($orden)
  {
    return $this->performRequest('DELETE', "/orden/{$orden}");
  }
}
