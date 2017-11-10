<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class MovieController extends Controller
{
    protected $movieInfo;

    public function __construct($movieInfo)
    {
        $this->movieInfo      = $this->validateInfo($movieInfo);
    }

    /**
     * Validate the formate of information and modify if not meet standard
     * @param $movieInfo array
     * @return array
     */
    public function validateInfo($movieInfo)
    {
        foreach($movieInfo as $movieIndex=>$movie)
        {
            if($movie)
            {
                if(!isset($movie->name))
                    $movie->name = "";

                if(!isset($movie->roles))
                    $movie->roles = array();

                $roles = $movie->roles;
                if($roles)
                {
                    foreach($roles as $roleIndex=>$role)
                    {
                        if(!isset($role->name))
                            $roles[$roleIndex]->name = "";

                        if(!isset($role->actor))
                            $roles[$roleIndex]->actor = "";
                    }
                }
                $movie->roles = $roles;
                $movieInfo[$movieIndex] = $movie;
            }
        }
        return $movieInfo;
    }

    /**
     * Find all actors and sort
     * @return array
     */
    public function getActors()
    {
        $actors = array();
        foreach($this->movieInfo as $movie)
        {
            $roles = $movie->roles;
            foreach($roles as $role)
            {
                if(!in_array($role->actor, $actors))
                {
                    array_push($actors, $role->actor);
                }
            }
        }
        sort($actors);
        return $actors;
    }

    /**
     * Find file and roles of an actor and sort by the film name
     * @param $actor string
     * @return array
     */
    public function getRoles($actor)
    {
        $roles = array();
        foreach($this->movieInfo as $movie)
        {
            foreach($movie->roles as $role)
            {
                if($role->actor == $actor)
                {
                    if(!array_key_exists($movie->name, $roles))
                        $roles[$movie->name] = array();

                    if(!in_array($role->name, $roles[$movie->name]))
                        array_push($roles[$movie->name], $role->name);
                }
            }
        }
        //Sort array by keys(movie name)
        ksort($roles);
        return $roles;
    }

    /**
     * Find all actors and their roles
     * @return array
     */
    public function getActorsAndRoles()
    {
        $actors = $this->getActors();
        $actorsRoles = array();
        foreach($actors as $actor)
        {
            $roles = $this->getRoles($actor);
            $actorsRoles[$actor] = $roles;
        }
        return $actorsRoles;
    }
}
