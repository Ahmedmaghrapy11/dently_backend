<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('longitude', 5, 2);
            $table->decimal('latitude', 5, 2);
            $table->string('city');
            $table->string('phone');
            $table->string('image');
            $table->string('delivary_times')->default('');
            $table->boolean('maxillofacial');
            $table->boolean('digital');
            $table->boolean('pay_per_month');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labs');
    }
}
