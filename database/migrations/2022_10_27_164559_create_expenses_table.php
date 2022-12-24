<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expense_date');
            $table->string('expense_head')->nullable();
            $table->string('project_name')->nullable();
            $table->string('receiver')->nullable();
            $table->string('voucher_no')->nullable();
            $table->string('expense_details')->nullable();
            $table->string('amount')->nullable();
            $table->string('total')->nullable();
            $table->string('source')->nullable();
            $table->string('attachment')->nullable();
            $table->text('payment_note')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('expenses');
    }
};
