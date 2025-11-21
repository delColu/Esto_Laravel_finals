<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $primaryKey = 'ShopId'; // EXACT match
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'Owner_fname',
        'Owner_lname',
        'shopname',
        'Item_category',
        'catID',
        'subcat',
        'SubCatID'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'catID', 'catID');
    }

}
