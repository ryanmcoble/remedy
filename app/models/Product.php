<?php

class Product extends Eloquent {

  protected $table = 's_products';
  protected $fillable = ['shop_id',
                         'shopify_id', 
                         'handle', 
                         'title', 
                         'body_html',
                         'vendor',
                         'product_type',
                         'published_at',
                         'published_scope',
                         'template_suffix',
                         'tags',
  ];


  public function shop()
  {
    return $this->belongsTo('Shop');
  }

  public function variants()
  {
    return $this->hasMany('ProductVariant', 'product_id', 'id');
  }

  public function images()
  {
    return $this->hasMany('ProductImage', 'product_id', 'id');
  }

  public function metafields()
  {
    return $this->hasMany('ProductMetafield', 'product_id', 'id');
  }

  public function options()
  {
    return $this->hasMany('ProductOption', 'product_id', 'id');
  }

  
}