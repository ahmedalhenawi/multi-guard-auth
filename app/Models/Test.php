<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;

class Test extends Model
{
    use HasFactory , HasTranslations ;
    protected $fillable = ['name'];
    public $translatable = ['name'];

}
