<?php

class ProductVariant extends Eloquent {

  protected $table = 's_product_variants';
  protected $fillable = ['product_id',
                         'shopify_id',
                         'shopify_product_id',
                         'title', 
                         'price',
                         'compare_at_price',
                         'sku',
                         'barcode',
                         'position',
                         'grams',
                         'inventory_policy',
                         'inventory_management',
                         'inventory_quantity',
                         'old_inventory_quantity',
                         'fulfillment_service',
                         'requires_shipping',
                         'taxable',
                         'option1',
                         'option2',
                         'option3',
                         'shopify_image_id',
                         'weight',
                         'weight_unit',

  ];

  public function product()
  {
    return $this->belongsTo('Product');
  }

  public function metafields()
  {
    return $this->hasMany('ProductVariantMetafield', 'variant_id', 'id');
  }

  
}