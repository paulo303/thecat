<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BreedController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Breed::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        $dados['breeds'][0]['url_image'] = $dados['url'];
        $gato = $dados['breeds'][0];


        DB::transaction(function() use ($gato) {
            $extensao = substr($gato['url_image'], -3);
            $filename = 'upload/' . $gato['id'] . '.' . $extensao;

            File::ensureDirectoryExists(public_path() . '/upload');

            $file = file_get_contents($gato['url_image']);
            $fp = fopen($filename, 'w+');

            fwrite($fp, $file);
            fclose($fp);

            if (!Breed::checkIfExists($gato['name'])) {
                $newBreed = Breed::create([
                    'name' => $gato['name'],
                    'code' => $gato['id'],
                    'url_image' => $filename,
                    'origin' => $gato['origin'],
                    'weight_metric' => $gato['weight']['metric'],
                    'life_span' => $gato['life_span'],
                    'description' => $gato['description'],
                    'wikipedia_url' => $gato['wikipedia_url'],
                ]);

                if(!$newBreed) {
                    return response()->json('Erro ao salvar', 400);
                }
            }
        });

        return response()->json('Sucesso', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $busca = Breed::searchByName($request->name);

        return response()->json($busca, 200);
    }
}
