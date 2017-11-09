<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\API\MovieConnection;

class PageController extends Controller
{
    protected $movieController;

    public function __construct()
    {
        $movieConnection       = new MovieConnection();
        $response              = $movieConnection->getResponse();
        $response              = json_decode($response);
        $this->movieController = new MovieController($response);
    }

    // Home page - Actor list
    public function actorList()
    {
        $actorsRoles = $this->movieController->getActorsAndRoles();
        return view('actors', compact("actorsRoles"));
    }
}
