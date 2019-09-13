<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\TareaRequest;
use App\Tarea;
use App\Http\Resources\TareaResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Tarea::all();
        return TareaResource::collection(auth()->user()->tareas()->with('creator')->latest()->paginate(10));
    }

    public function indexDatos(Request $request)
    {
        $request->validate([
            'limit'=>'integer|min:1',
            'current_page'=>'integer|min:1'
        ]);
        $currentPage = $request->current_page;
        $limit = $request->limit;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        //dd(TareaResource::collection(auth()->user()->tareas()->with('creator')->latest()->paginate(2)));
        return TareaResource::collection(auth()->user()->tareas()->with('creator')->latest()->paginate($request->limit));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TareaRequest $request)
    {
        /*$request->validate([
            'title'=>'required|max:225'
        ]);*/

        //dd($request);

        $task = auth()->user()->tareas()->create($request->all());

        return new TareaResource($task->load('creator'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Tarea::findOrFail($id);
        return response()->json(['data' => $producto, 'success' => true],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TareaRequest $request, $id)
    {
        dd($request,$id);
        $task = Tarea::findOrFail($id);
        if(isset($request->title)){
            dd("simon");
        }
        dd("me");
        $task = auth()->user()->tareas()->create($request->all());
        return new TareaResource($task->load('creator'));
    }

    public function update_custom(TareaRequest $request)
    {
        try
        {
            //TODO
            $task = Tarea::findOrFail($request->id_tarea);

            $task->title = $request->title;
            $task->description = $request->description;
            $r = $task->save();
            if($r)
                return new TareaResource($task->load('creator'));
            else
                return response()->json(['message' => "Error inesperado", 'success' => false],400);
        } catch (\Exception $e)
        {
            $xd = "Error: ".$e->getMessage();
            return response()->json(['message' => $xd, 'success' => false],400);
        }
        /*if(isset($request->id_tarea))
        {
            //TODO
            $task = Tarea::findOrFail($request->id_tarea);

            $task->title = $request->title;
            $task->description = $request->description;
            $r = $task->save();
            if($r)
                return new TareaResource($task->load('creator'));
            else
                return response()->json(['message' => "Error inesperado", 'success' => false],400);
        } else
        {
            return response()->json(['message' => "No se encuentra la tarea", 'success' => false],400);
        }*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyed(Request $request)
    {
        $request->validate([
            'id_tarea'=>'required|min:1'
        ]);
        $id = $request->id_tarea;
        try
        {
            $pregunta = Tarea::findOrFail($id);
            $r = $pregunta->delete();
            if($r)
                return response()->json(['message' => "Datos eliminados correctamente", 'success' => true],200);
            return response()->json(['message' => "Oops! Ha ocurrido algun error", 'success' => false],400);
        } catch (\Exception $e)
        {
            $xd = "Error: ".$e->getMessage();
            return response()->json(['message' => $xd, 'success' => false],400);
        }
    }
}
