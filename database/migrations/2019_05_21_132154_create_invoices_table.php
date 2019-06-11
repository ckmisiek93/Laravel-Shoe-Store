<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->string('title');
             $table->double('price', 2);
             $table->string('city');
             $table->text('adress');
             $table->string('phone');
             $table->string('email');
             $table->text('info')->nullable();
             $table->integer('user_id')->nullable();
             $table->string('shoe_ids')->nullable();
             $table->boolean('delivery')->default(0);
             $table->string('payment_status')->default('not completed');
             $table->string('recurring_id')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
