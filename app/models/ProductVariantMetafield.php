<?php

class ProductVariantMetafield extends Eloquent {

  protected $table = 's_product_variant_metafields';
  protected $fillable = ['variant_id',
                         'shopify_id', 
                         'shopify_variant_id',
                         'namespace', 
                         'key', 
                         'value',
  ];


  public function variant()
  {
    return $this->belongsTo('ProductVariant');
  }

  
}