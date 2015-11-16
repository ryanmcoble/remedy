<?php

class ProductOption extends Eloquent {

  protected $table = 's_product_options';
  protected $fillable = ['product_id',
                         'shopify_id',
                         'shopify_product_id',
                         'name', 
                         'position', 
                         'values', // comma separated
  ];


  public function product()
  {
    return $this->belongsTo('Product');
  }

  
}