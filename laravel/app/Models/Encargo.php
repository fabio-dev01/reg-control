<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encargo extends Model
{
    use HasFactory;

    public function user()
    {
    	return $this->belongsTo('App\Models\Encargo');
    }

    	//permite salvar datas
    protected $dates = ['date'];

    protected $guarded = [];
}
