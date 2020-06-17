<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateProductsTable extends Migration
{
    /** * Run the migrations. * * @return void */
    public function up()
    {
        Schema::create('products', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('images');
            $table->string('title');
            $table->integer('old_price')->default(false);
            $table->integer('price');
            $table->string('availability');
            $table->string('condition');
            $table->integer('quantity');
            $table->string('web_id');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->integer('color_id');
            $table->integer('year_id');
            $table->timestamps();
        });
    }
    /** * Reverse the migrations. * * @return void */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
