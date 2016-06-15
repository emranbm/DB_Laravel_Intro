<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsToTasksTable extends Migration
{
    /**
     * Run the migrations.
	 * Avoids undesired up comming migration. allways do php artisan migrate
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
			
            //add new columns to table tasks
            $table->string('type');
            $table->date('start_date');
            $table->integer('day_estimation');
            $table->renameColumn('is_done', 'state');
            $table->string('co_worker');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            //

        });
    }
}
