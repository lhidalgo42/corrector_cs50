<?php

class StudentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /students
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('students.home');
	}

	public function search($rut){
        $students = Student::where('rut','like',$rut.'%')->take(5)->select('rut')->lists('rut');
        return $students;
    }

	public function show($rut){
        $student = Student::where('rut',$rut)->get();
		$homeworks = (count($student)>0)?$student->first()->homeworks:[];
        return $homeworks;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /students/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function admin()
	{
		$students = Student::paginate(15);
		return View::make('teachers.content.students')->with(compact('students'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /students/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /students/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}