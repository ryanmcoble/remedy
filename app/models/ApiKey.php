<?php

class ApiKey extends Eloquent {

  protected $table = 'api_keys';

  protected $fillable = ['shop_id',
                         'public_key',
                         'access_level_id',
  ];


  public function shop()
  {
    return $this->belongsTo('Shop');
  }

  public function accessLevel()
  {
    return $this->belongsTo('AccessLevel', 'access_level_id', 'id');
  }

  public function logs()
  {
    return $this->hasMany('ApiLog', 'api_key_id', 'id');
  }
  
}