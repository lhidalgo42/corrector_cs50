<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_student', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('student1_id')->unsigned()->index();
			$table->foreign('student1_id')->references('id')->on('students')->onDelete('cascade');
			$table->integer('student2_id')->unsigned()->index();
			$table->foreign('student2_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('levenshtein');
            $table->integer('homework_id')->unsigned()->index();
            $table->foreign('homework_id')->references('id')->on('homeworks')->onDelete('cascade');
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
		Schema::drop('student_student');
	}

}
