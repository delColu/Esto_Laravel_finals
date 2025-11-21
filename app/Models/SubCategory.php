<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{

    use HasFactory;
    protected $primaryKey = 'SubCatID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'description',
        'catID'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'catID', 'catID');
    }
}
