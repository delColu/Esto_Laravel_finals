<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // /**
    //  * Run the migrations.
    //  * protected $primaryKey = 'catID';
    // // public $incrementing = true;
    // // protected $keyType = 'int';

    // // protected $fillable = [
    // //     'name',
    // //     'description',
    // //     'Sub_cat_of',
    // //     'catID'
    // // ];
    //  */
    public function up(): void
    {
        Schema::create('Sub_Categories', function(Blueprint $table) {
            $table->id('SubCatID');
            $table->string('name');
            $table->string('description');
            $table->string("catID");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
