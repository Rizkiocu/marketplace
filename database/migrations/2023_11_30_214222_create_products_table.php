<?php

use App\Models\product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();;
            $table->string('name');
            $table->string('price');
            $table->string('description');
            $table->timestamps();
        });

        // // untuk menambah data example secara otomatis ke database
        // $faker =\Faker\Factory::create();
        // for ($i=0; $i < 10; $i++) { 
        //  product::create([
        //     'name' => $faker->word,
        //     'price' => $faker->randomNumber(3, true),
        //     'description' => $faker->sentence(5, true)
        //  ]);
        // }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
