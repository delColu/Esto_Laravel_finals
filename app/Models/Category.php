<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'catID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'description'
    ];

    public function subcategories()
        {
            return $this->hasMany(SubCategory::class, 'catID', 'catID');
        }

}
