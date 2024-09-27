<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Libro;

class Libros extends Controller{

    public function index() {

        $libro = new Libro();
        $datos['libros'] = $libro->orderBy('id','ASC')->findAll();

        $datos['cabecera'] = view('template/cabecera');
        $datos['piepagina'] = view('template/piepagina');
        
        return view('libros/listar', $datos);
    }

    public function crear(){

        $datos['cabecera'] = view('template/cabecera');
        $datos['piepagina'] = view('template/piepagina');

        return view('libros/crear', $datos);
    }

    public function guardar(){

        $libro = new Libro();

       $nombre=$this->request->getVar('nombre');

       if($imagen=$this->request->getFile('imagen')){
            $nuevoNombre = $imagen->getRandomName();
            $imagen->move('../public/uploads/',$nuevoNombre);
            $datos=[
                'nombre'=>$nombre,
                'imagen'=>$nuevoNombre
            ];
            $libro->insert($datos);
       } 
       //echo "Libro ingresado con exito";
       //print_r($nombre);
       return $this->response->redirect(site_url('/listar'));
    }

    public function borrar($id = null) {

        $libro = new Libro();
        $datosLibro = $libro->where('id',$id)->first();

        $ruta = ('../public/uploads/'.$datosLibro['imagen']);
        unlink($ruta);

        $libro->where('id',$id)->delete();

        return $this->response->redirect(site_url('/listar'));
    }

    public function editar($id = null) {
        print_r($id);
        $libro = new Libro();
        $datos['libro'] = $libro->where('id',$id)->first();

        $datos['cabecera'] = view('template/cabecera');
        $datos['piepagina'] = view('template/piepagina');

        return view('libros/editar', $datos);
    }

    public function actualizar() {

        $libro = new Libro();
        $datos=[
            'nombre'=> $this->request->getVar('nombre')
        ];
        $id = $this->request->getVar('id');
        $libro->update($id, $datos);
    }

}

    /* public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM libros');  // Ajusta la tabla según tu caso
        $result = $query->getResultArray();  // Puedes usar getResult() o getResultArray()
    
        if (!empty($result)) {
            return var_dump($result);  // Esto mostrará los resultados en la página
        } else {
            return "No se encontraron datos.";
        }
    } */