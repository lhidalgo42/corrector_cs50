<?php

class ImportController extends \BaseController
{

    /**
     * Display a listing of the resource.
     * GET /import
     *
     * @return Response
     */
    public function index()
    {
        return View::make('teachers.content.import');
    }

    /**
     * Show the form for creating a new resource.
     * GET /import/create
     *
     * @return Response
     */
    public function students()
    {
        $file = Input::file('file');
            $path = $file->getRealPath();
        $row = 1;
        if (($handle = fopen($path, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                 if($row != 1) {
                     $count = Student::where('rut',str_replace(".","",$data[1]))->count();
                     if($count==0) {
                         $student = new Student();
                         $student->rut = str_replace(".", "", $data[1]);
                         $student->name = $data[3] . " " . $data[2];
                         $student->email = $data[6];
                         $student->course_id = Input::get('seccion');
                         $student->save();
                     }
                 }
                $row++;
            }
            fclose($handle);

        }
        return Redirect::back();

    }

    /**
     * Store a newly created resource in storage.
     * POST /import
     *
     * @return Response
     */
    public
    function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /import/{id}
     *
     * @param  int $id
     * @return Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /import/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public
    function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /import/{id}
     *
     * @param  int $id
     * @return Response
     */
    public
    function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /import/{id}
     *
     * @param  int $id
     * @return Response
     */
    public
    function destroy($id)
    {
        //
    }

}