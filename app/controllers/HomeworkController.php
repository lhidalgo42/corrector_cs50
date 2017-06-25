<?php

class HomeworkController extends \BaseController
{

    /**
     * Display a listing of the resource.
     * GET /homework
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * GET /homework/create
     *
     * @return Response
     */
    public function create()
    {
        return View::make('teachers.content.homeworks');
    }

    /**
     * Store a newly created resource in storage.
     * POST /homework
     *
     * @return Response
     */
    public function store()
    {
        $zip = Input::file('zip');
        $fileName = $zip->getClientOriginalName();
        $homework = Homework::where('name', Input::get('name'))->where('week', Input::get('week'))->where('course_id', Input::get('course'))->get();

        if (count($homework) == 0) {
            $homework = new Homework();
            $homework->name = Input::get('name');
            $homework->week = Input::get('week');
            $homework->course_id = Input::get('course');
            $homework->save();

            $optionType = array("int", "string", "char");
            for ($i = 0; $i < count(Input::get('options')['int']); $i++) {
                for ($j = 0; $j < count($optionType); $j++) {
                    $option = new Option();
                    $option->param = "GET" . $optionType[$j];
                    $option->value = Input::get('options')[$optionType[$j]][$i];
                    $option->homework_id = $homework->id;
                    $option->save();
                }
            }
        }
        else
            $homework = $homework->first();

        $path = public_path() . '/' .Input::get('course').'/'. Input::get('week') . '/' . Input::get('name');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $zip->move($path, "archivo.zip");
        #################################
        Zipper::make($path . '/archivo.zip')->extractTo($path);
        $files = File::allFiles($path);
        foreach ($files as $file) {
            if (substr($file, -4) != "html") {
                $fileName = iconv(mb_detect_encoding($file, mb_detect_order(), true), "UTF-8", $file);
                $palabras = explode('_', $fileName);
                $type = 0;
                if (count($palabras) == 5) {
                    $type = 1;
                    $rut = $palabras[4];
                } else if (count($palabras) == 6) {
                    $type = 2;
                    $ruts = array($palabras[4], $palabras[5]);
                }
                $folders = explode('\\', $palabras[0]);
                $studentName = $folders[count($folders) - 1];
                if ($studentName != 'archivo.zip') {
                    $parcialName = explode(" ", $studentName);
                    $student = Student::where('name', 'LIKE', '%' . $parcialName[0] . '%')->where('name', 'LIKE', '%' . $parcialName[1] . '%')->where('name', 'LIKE', '%' . $parcialName[2] . '%')->get();
                    if (count($student) == 1) {
                        $student = $student->first();
                        $entrega = HomeworkStudent::where('homework_id',$homework->id)->where('student_id',$student->id)->get();
                            if(count($entrega)==0){
                                $entrega = new HomeworkStudent();
                                $entrega->homework_id = $homework->id;
                                $entrega->student_id = $student->id;
                                $entrega->filename = $file;
                                if(Input::get('check') == 'exist'){
                                    $entrega->grade = 7;
                                }
                                else {
                                    if (substr($file, -1) == "c") {
                                        $content = file_get_contents($file);
                                        for ($i = 0; $i < count(Input::get('options')['int']); $i++) {
                                            $content = preg_replace('GetInt()', Input::get('options')['int'][$i], $content, 1);
                                            $content = preg_replace('GetChar()', '"'.Input::get('options')['char'][$i].'"', $content, 1);
                                            $content = preg_replace('GetString()', '"'.Input::get('options')['string'][$i].'"', $content, 1);
                                        }
                                        file_put_contents($file,$content);
                                    }
                                }
                                $entrega->save();
                            }
                        }
                    else
                        echo "Error " . $file;
                }

            }
        }

    }

}