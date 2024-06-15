<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PageController extends Controller {
  public function index() {
    return Inertia::render('MainPage', [
      'userinfo' => Auth::user()->rol->nombre
    ]);
  }
}
