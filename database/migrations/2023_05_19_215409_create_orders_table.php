<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('lab_id');
            $table->foreignId('clinic_id');
            $table->integer('case_number');
            $table->string('patient_name');
            $table->string('gender');
            $table->date('due_date');
            $table->string('product_type');
            $table->string('payment_type');
            $table->date('expected_receive_date');
            $table->string('shade');
            $table->string('stain');
            $table->string('description');
            $table->boolean('is_fixed');
            $table->integer('restoration_type');
            $table->string('all_ceramics');
            $table->string('post_and_core');
            $table->string('on_implant');
            $table->string('pfm');
            $table->string('full_cast');
            $table->string('acrylic_full_denture');
            $table->string('acrylic_partial_denture');
            $table->string('flexible');
            $table->string('cast_partial_denture');
            $table->string('immediates');
            $table->string('teeth');
            $table->string('miscellanceous');
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
        Schema::dropIfExists('orders');
    }
}
