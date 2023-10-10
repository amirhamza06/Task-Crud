<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Contact extends Model
{
    use HasFactory;

    
    protected $fillable=[
        'name',
        'email',
        'phone',
        'notes',
        'user_id',
    ];

    public function phone() {
        return $this->belongsTo(Phone::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->user_id = auth()->id();

        });

        self::addGlobalScope(function(Builder $builder){


            if (auth()->id() == 1) {
                $builder;
            }
            else{
                $builder->where('user_id',auth()->id());
            }
        });
    }
}
