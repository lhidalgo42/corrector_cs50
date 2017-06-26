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
        ## CREACION DE LA ACTIVIDAD EN LA BBDD, SI NO EXISTE SE CREA UNA ###
        $homework = Homework::where('name', Input::get('name'))->where('week', Input::get('week'))->where('course_id', Input::get('course'))->get();

        if (count($homework) == 0) {
            $homework = new Homework();
            $homework->name = Input::get('name');
            $homework->week = Input::get('week');
            $homework->course_id = Input::get('course');
            $homework->save();
            #################### END CREACION DE ACTIVIDAD #####################
            ############# CREACION DE OPCIONES DE REEMPLAZO EN LA ACTIVIDAD ####
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
            ################# END CREACION DE OPCIONES #########################
        } else
            $homework = $homework->first();
        ################ CREACION DE CARPETA ###############################
        $path = public_path() . '/' . Input::get('course') . '/' . Input::get('week') . '/' . Input::get('name');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        } else {
            File::deleteDirectory($path);
            File::makeDirectory($path, 0777, true, true);
        }
        ############### END CREACION DE CARPETA ###########################
        ## SIEMPRE SE CREA UNA CARPETA NUEVA Y SE BORRA TODO DE LA ANTERIOR
        ###################################################################
        ################### MOVER Y EXTRAER ARCHIVO #######################
        $zip->move($path, "archivo.zip");
        Zipper::make($path . '/archivo.zip')->extractTo($path);
        ################### END MOVER Y EXTRAER ARCHIVO ###################
        ###### SIEMPRE SE LE PONE archivo.zip, para ignorarlo despues #####
        ###################################################################
        $files = File::allFiles($path);
        foreach ($files as $file) {
            $fileInfo = pathinfo($file);
            $extension = $fileInfo['extension'];
            $file = $fileInfo['basename'];
            $dirName = $fileInfo['dirname'];
            if($extension == 'html')
                File::delete($dirName.'/'.$file);
            if ($extension != "html" && $file != "archivo.zip") {

                $fileName = iconv(mb_detect_encoding($file, mb_detect_order(), true), "UTF-8", $file);
                $palabras = explode('_', substr($fileName, 0, -2));
                $studentName = $palabras[0];
                $GLOBALS['partialName'] = explode(" ", $studentName);

                $ruts = array();
                if (count($palabras) == 5)
                    $ruts = array($palabras[4]);
                elseif (count($palabras) == 6)
                    $ruts = array($palabras[4], $palabras[5]);

                $students = array();
                if (count($ruts) == 2) {
                    $students = Student::where('rut', 'LIKE', '%' . $ruts[0] . '%')->orWhere('rut', 'LIKE', '%' . $ruts[1] . '%')->orWhere(function ($query) {
                        $query->where('name', 'LIKE', '%' . $GLOBALS['partialName'][0] . '%')
                            ->where('name', 'LIKE', '%' . $GLOBALS['partialName'][1] . '%')
                            ->where('name', 'LIKE', '%' . $GLOBALS['partialName'][2] . '%');
                    })->get();
                } elseif (count($ruts) == 1) {
                    $students = Student::where('rut', 'LIKE', '%' . $ruts[0] . '%')->orWhere(function ($query) {
                        $query->where('name', 'LIKE', '%' . $GLOBALS['partialName'][0] . '%')
                            ->where('name', 'LIKE', '%' . $GLOBALS['partialName'][1] . '%')
                            ->where('name', 'LIKE', '%' . $GLOBALS['partialName'][2] . '%');
                    })->get();
                } elseif (count($ruts) == 0) {
                    $students = Student::where('name', 'LIKE', '%' . $GLOBALS['partialName'][0] . '%')
                        ->where('name', 'LIKE', '%' . $GLOBALS['partialName'][1] . '%')
                        ->where('name', 'LIKE', '%' . $GLOBALS['partialName'][2] . '%')->get();
                }

                foreach ($students as $student) {
                    $entrega = HomeworkStudent::where('homework_id', $homework->id)->where('student_id', $student->id)->get();
                    if (count($entrega) == 0 || true) {
                        $entrega = new HomeworkStudent();
                        $entrega->homework_id = $homework->id;
                        $entrega->student_id = $student->id;
                        $entrega->filename = $file;
                        if (Input::get('check') == 'exist')
                            $entrega->grade = 7;

                        if ($extension == 'c') {
                            $consoleFileName =preg_replace('/[^\00-\255]+/u', '', substr(str_replace(" ", "_", $file), 0, -2));
                            $content = file_get_contents($dirName.'/'.$file);
                            for ($i = 0; $i < count(Input::get('options')['int']); $i++) {
                                $content = preg_replace('/GetInt()/', '"' . Input::get('options')['int'][$i] . '"', $content, 1);
                                $content = preg_replace('/GetChar()/', '"' . Input::get('options')['char'][$i] . '"', $content, 1);
                                $content = preg_replace('/GetString()/', '"' . Input::get('options')['string'][$i] . '"', $content, 1);
                            }

                            file_put_contents($dirName.'/'.$consoleFileName.'.c', $content);
                            $console = exec('cd "' . $dirName . '"            
                            make ' . $consoleFileName);
                            $console = exec('cd "' . $dirName . '" 
                            ./'.$consoleFileName);
                            $entrega->console = $console;
                            if(!empty($console))
                                $entrega->grade = 7;
                            else
                                $entrega->grade = 4;
                            $entrega->content = $content;

                        }
                        $entrega->save();
                    }

                }
            }


        }
        return Redirect::back();
    }
}