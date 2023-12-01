<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class product extends Model
{
    use HasFactory;
    protected $fillable=['name','price','description'];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        // Menetapkan UUID saat menyimpan model baru
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Uuid::uuid4();
        });
    }
}
