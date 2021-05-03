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
class publishController extends BaseController
{
    public function publish(Request $req){
        $idusuario = Session::get('id');
        $titulo = $req->input('titulo');
        $cuerpo = $req->input('cuerpo');
        $categoria = $req->input('categoria');
        $fecha = Carbon::now()->toDateTimeString();
        $tipo = Session::get('tipo');

  
        

        $tnota = 0;
        if ($tipo == 0 || $tipo == 1){
            $tnota = 0;
        }
        if($tipo == 2){
            $tnota = 1;
        }
        if($tipo == 3){
            $tnota = 2;
        }

        $query1 = DB::table('categorias')->where(['nombre'=>$categoria])->get();
        foreach($query1 as $query1){
            $idcategoria = $query1->idCategoria;
        }

        $query2 = DB::table('notas')->insertGetId(
            ['titulo'=>$titulo,
            'autor'=>$idusuario,
            'categoria'=>$idcategoria,
            'fecha'=>$fecha,
            'cuerpo'=>$cuerpo,
            'Reporte'=>$tnota,
            ]
        );

    /*  if ($req->hasFile('vid')) {
            $vid = $req->file('vid');
            $ext2 = $vid->getClientOriginalExtension();
            $vid->move(public_path('assets/imgenes/nota/vid'), $query2.'.'.$ext2);
            $query3 = DB::table('nota')->where(['idNota'=>$query2])->update(['vid' => $ext2]);
        } */

        $img = $req->file('imagen0');
        $ext1 = $img->getClientOriginalExtension();
        //$img->storeAs('assets/imgenes/nota/img', $query2.'.'.$ext1);
        $img->move(public_path('assets/imgenes/nota/img'), $query2.'.'.$ext1);
        $query3 = DB::table('notas')->where(['idNota'=>$query2])->update(['img' => $ext1]);
        return Redirect::to('/');

    }
}
?>