<?php

class AccessLevel extends Eloquent {

  protected $table = 'api_access_levels';

  protected $fillable = ['level',
                         'request_limit',
                         'interval_type',
                         'interval_value',
  ];
  
}