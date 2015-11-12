<?php

class ProductMetafield extends Eloquent {

  protected $table = 's_product_metafields';
  protected $fillable = ['product_id',
                         'shopify_id', 
                         'shopify_product_id',
                         'namespace', 
                         'key', 
                         'value',
  ];


  public function product()
  {
    return $this->belongsTo('Product');
  }

  
}