<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'background'];

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        self::creating(function ($note){
            $note->background = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        });
    }
}
