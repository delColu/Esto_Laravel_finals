<?php

use App\Models\Shop;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // /**
    //  * Run the migrations.protected $fillable = [
    //  */
    public function up(): void
    {
        Schema::create('Shops', function(Blueprint $table) {
            $table->id('ShopId');
            $table->string('Owner_fname');
            $table->string('Owner_lname');
            $table->string("shopname");
            $table->string("Item_category");
            $table->string("catID");
            $table->string('subcat')->nullable();
            $table->string('SubCatID')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Shops');
    }
};
