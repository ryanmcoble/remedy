<?php

class ProductImage extends Eloquent {

  protected $table = 's_product_images';
  protected $fillable = ['product_id',
                         'shopify_id', 
                         'shopify_product_id',
                         'position', 
                         'src', 
                         'variant_ids', // comma separated
                         'vendor',
  ];


  public function product()
  {
    return $this->belongsTo('Product');
  }

  
}