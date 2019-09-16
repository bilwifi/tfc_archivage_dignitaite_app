<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ListDignitairesDataTable;
use App\Models\Medaille;

class PublicController extends Controller
{
    public function index(ListDignitairesDataTable $dataTable){
    	return $dataTable->render('welcome');
    }

    public function showMedaille(Medaille $medaille){
    	return view('_view_medaille',compact('medaille'));
    }
}
