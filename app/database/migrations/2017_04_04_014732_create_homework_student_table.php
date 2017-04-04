<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHomeworkStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('homework_student', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('homework_id')->unsigned()->index();
			$table->foreign('homework_id')->references('id')->on('homeworks')->onDelete('cascade');
			$table->integer('student_id')->unsigned()->index();
			$table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->string('filename');
            $table->string('console');
            $table->integer('levenshtein');
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
		Schema::drop('homework_student');
	}

}
