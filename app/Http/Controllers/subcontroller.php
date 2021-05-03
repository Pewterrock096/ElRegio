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
class subController extends BaseController
{
    public function subscribe(Request $req){

        $usuario = $req->id;
        $idNota = $req->nota;
        $subscriptor = Session::get('id');

        $query = DB::table('subscripciones')->insertGetId(
            ['subscriptor' => $subscriptor,
             'usuario' => $usuario,
             ]
        );


        return Redirect::to('noticia?id='.$idNota);

    }

    public function unsub(Request $req){

        $usuario = $req->id;
        $idNota = $req->nota;
        $subscriptor = Session::get('id');

        $query =DB::table('subscripciones')->where([ ['subscriptor', '=', $subscriptor], ['usuario', '=', $usuario] ])->delete();


        return Redirect::to('noticia?id='.$idNota);

    }

    public function subscribe2(Request $req){

        $usuario = $req->id;
        $subscriptor = Session::get('id');

        $query = DB::table('subscripciones')->insertGetId(
            ['subscriptor' => $subscriptor,
             'usuario' => $usuario,
             ]
        );


        return Redirect::to('perfil?id='.$usuario);

    }

    public function unsub2(Request $req){

        $usuario = $req->id;
        $subscriptor = Session::get('id');

        $query =DB::table('subscripciones')->where([ ['subscriptor', '=', $subscriptor], ['usuario', '=', $usuario] ])->delete();


        return Redirect::to('perfil?id='.$usuario);

    }
}
?>