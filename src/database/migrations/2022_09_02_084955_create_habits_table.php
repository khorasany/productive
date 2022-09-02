<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habits', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->default(null);
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('habit_type')->default('Daily'); // Daily Weekly Monthly
            $table->boolean('habit_goal')->default(0); // If value set 1 user must fill several times or time of habit goal
            $table->integer('several_times')->nullable();
            $table->string('time')->nullable();
            $table->boolean('repeat_every_day')->default(1);
            $table->text('selected_days')->nullable(); // If repeat every day set 0 user must fill selected days of week
            $table->boolean('repeat_daily')->default(1);
            $table->text('daily_momentum')->nullable(); // If repeat daily set 0 user must fill each daily momentum
            $table->boolean('end_of_habit')->default(0);
            $table->string('type_end_of_habit')->nullable();
            $table->string('end_date')->nullable();
            $table->string('goal_amount')->nullable();
            $table->string('reminder_time')->nullable();
            $table->text('description')->nullable();
            $table->string('elapsed_time_habituation')->default(0);
            $table->boolean('status')->default(1);
            $table->boolean('done_status')->default(1);
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
        Schema::dropIfExists('habits');
    }
}
