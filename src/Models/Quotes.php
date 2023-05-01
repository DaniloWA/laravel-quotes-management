<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotes extends Model
{
    /* Table Name */
    protected $table = 'quotes';

    /* Primary Key */
    protected $primaryKey = 'id';

    /* Timestamps */
    public $timestamps = true;

    /* Casts */
    protected $casts = [
        'length' => 'integer',
        'uuid' => 'string',
        'author' => 'string',
        'author_slug' => 'string',
        'quote' => 'string',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'author',
        'author_slug',
        'quote',
        'length',
    ];

    protected $hidden = [
        'id',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->author_slug = Str::slug($model->author);
        });
    }
}
