<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome()
{
    return view('welcome'); // Retorna la vista welcome.blade.php
}

public function productos()
{
    return view('productos'); // Retorna la vista productos.blade.php
}

public function Inicio()
{
    return view('Inicio'); // Retorna la vista Inicio.blade.php
}
public function despacho()
{
    return view('despacho'); // Retorna la vista Despacho.blade.php
}

public function catalogos()
{
    return view('catalogos'); // Retorna la vista Catalogos.blade.php
}

public function gestiones()
{
    return view('gestiones'); // Retorna la vista Despacho.blade.php
}

public function catalogosClientes()
{
    return view('catalogosClientes'); // Retorna la vista catalogosClientes.blade.php
}

}
