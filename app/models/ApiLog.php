<?php

class ApiLog extends Eloquent
{
	protected $table = 'api_logs';

	protected $fillable = [
		'api_key_id',
        'status',
        'message',
        'ip_address',
    ];

    public function apiKey()
    {
    	return $this->belongsTo('ApiKey', 'api_key_id', 'id');
    }
}