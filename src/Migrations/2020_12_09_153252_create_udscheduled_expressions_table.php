<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUDScheduledExpressionsTable extends Migration
{
    /**
     * Run the Migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('udscheduled_expressions', function (Blueprint $table) {
            $table->id();
            $table->integer('scheduler_id');
            $table->string('scheduler_type');
            $table->string('schedulable');
            $table->string('expression');
            $table->string('timezone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the Migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('udscheduled_expressions');
    }
}
