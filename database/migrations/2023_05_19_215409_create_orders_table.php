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
            $table->string('all_ceramics')->nullable();
            $table->string('post_and_core')->nullable();
            $table->string('on_implant')->nullable();
            $table->string('pfm')->nullable();
            $table->string('full_cast')->nullable();
            $table->string('acrylic_full_denture')->nullable();
            $table->string('acrylic_partial_denture')->nullable();
            $table->string('flexible')->nullable();
            $table->string('cast_partial_denture')->nullable();
            $table->string('immediates')->nullable();
            $table->string('teeth')->nullable();
            $table->string('miscellanceous')->nullable();
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
