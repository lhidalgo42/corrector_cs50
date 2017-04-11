<?php

class TeacherController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /teacher
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('teachers.home');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /teacher/create
	 *
	 * @return Response
	 */
	public function courses()
	{
        $courses = Course::where('year',date('Y'))->get();
        return View::make('teachers.content.courses')->with(compact('courses'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /teacher
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /teacher/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /teacher/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /teacher/{id}
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
	 * DELETE /teacher/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}