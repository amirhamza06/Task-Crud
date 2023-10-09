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

    protected function phone(): Attribute{
        return Attribute::make(
            get: fn($value) => json_decode($value,true),
            set: fn ($value) => json_encode($value,true),

        );
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
