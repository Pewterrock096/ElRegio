<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Auth\Access\Authorizes;
Use Carbon\Carbon;
use DB;
use Session;
use Redirect;
use Route;
class noteController extends BaseController
{
    public function upvote(Request $req){

        $idNota = $req->id;

        $query = DB::table('notas')->where(['idNota'=>$idNota])->get();

        foreach($query as $query){
            $calificacion = $query->calificación;
        }

        $calificacion = $calificacion + 1;
        $query2 = DB::table('notas')->where(['idNota'=>$idNota])->update(['calificación'=>$calificacion]);

        return Redirect::to('noticia?id='.$idNota);

    }

    public function downvote(Request $req){

        $idNota = $req->id;

        $query = DB::table('notas')->where(['idNota'=>$idNota])->get();

        foreach($query as $query){
            $calificacion = $query->calificación;
        }

        $calificacion = $calificacion - 1;
        $query2 = DB::table('notas')->where(['idNota'=>$idNota])->update(['calificación'=>$calificacion]);

        return Redirect::to('noticia?id='.$idNota);

    }

    public function comentar(Request $req){
        $idNota = $req->id;
        $comentario = $req->input('Comentar');
        $fecha = Carbon::now()->toDateTimeString();
        $idUsuario = Session::get('id');

        $query = DB::table('comentarios')->insertGetId(
            ['usuario' => $idUsuario,
             'nota' => $idNota,
             'comentario' => $comentario,
             'fecha' => $fecha
             ]
        );

        return Redirect::to('noticia?id='.$idNota);
    }
}
?>