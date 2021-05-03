<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Auth\Access\Authorizes;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DB;
use Session;
use Redirect;
use Route;
use Assets;
class loginController extends BaseController
{
     public function login(Request $req)
     {
      $username = $req->input('usuariologin');
      $password = $req->input('contralogin');
echo $username;
echo $password;

        $query =  DB::table('usuario')->where(['correo'=>$username,'contra'=>$password])->orderBy('idUsuario', 'asc')->limit(1)->get();
     
        if($query->isEmpty()){
            echo 'Error en Usuario o Contraseña';
        }
        else{
            echo 'nice';
            foreach ($query as $query){

                Session(['nombre' => $query->nombre]);
                Session(['apellido' => $query->apellido]);
                Session(['correo' => $query->correo]);
                Session(['id' => $query->idUsuario]);
                Session(['tipo' => $query->tipo]);
                Session(['ext'=>$query->ext]);
        
                echo Session::get('nombre');
                echo Session::get('apellido');
                echo Session::get('correo');
                echo Session::get('id');
            }

            return Redirect::to('/');
            
        }
 
      
     }
     public function registro(Request $req)
    {
        $username = $req->input('nombre');
        $surname = $req->input('apellido');
         $mail = $req->input('correo');
         $password = $req->input('contra');
         $file = $req->file('imgp');
         $tipo = '2';
            
        $ext = $file->getClientOriginalExtension();
         $imagePath = $file->getPathName();

         $query = DB::table('usuario')->insertGetId(
            ['nombre' => $username,
             'apellido' => $surname,
             'correo' => $mail,
             'contra' => $password,
             'tipo' => $tipo
             ]
        );

        Session(['nombre' => $username]);
        Session(['apellido' => $surname]);
        Session(['correo' => $mail]);
        Session(['id' => $query]);
        Session(['tipo'=> $tipo]);

        //$file->storeAs('assets/imgenes/perfil', $query.'.'.$ext);
        $file->move(public_path('assets/imgenes/perfil'), $query.'.'.$ext);
        //Storage::disk('public')->putFileAs('/imgenes/perfil', new file($imagePath), $query.'.'.$ext);
       // $ext = "jpg";
        $query2 = DB::table('usuario')->where(['idUsuario'=>$query])->update(['ext' => $ext]);
        Session(['ext' => $ext]);


        echo Session::get('nombre');
        echo Session::get('apellido');
        echo Session::get('correo');
        echo Session::get('id');

        return Redirect::to('/');
}
public function logout(Request $req)
{
    session()->flush();
    return Redirect::to('/');
}
}




?>