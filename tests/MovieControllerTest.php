<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\MovieController;

class MovieControllerTest extends TestCase
{
    protected $MovieController;

    public function setUp()
    {
        $movieInfo = array();
        $movieInfo[] = (object)array("name"=>"Beverly Hills Cop", "roles"=>[(object)array("name"=>"Axel Foley","actor"=>"Eddie Murphy")]);
        $movieInfo[] = (object)array("name"=>"Absolutely",        "roles"=>[(object)array("name"=>"Jenny Summers","actor"=>"Eddie Murphy")]);
        $movieInfo[] = (object)array("name"=>"",                  "roles"=>[(object)array("name"=>"Billy Rosewood","actor"=>"Judge Reinhold")]);
        $movieInfo[] = (object)array(                             "roles"=>[(object)array("name"=>"Chris Chambers","actor"=>"River Phoenix")]);
        $movieInfo[] = (object)array("name"=>"Stand By Me");
        $movieInfo[] = (object)array("name"=>"Star Trek",         "roles"=>[(object)array("name"=>"Romulan")]);
        $movieInfo[] = (object)array("name"=>"Family Guy",        "roles"=>[(object)array("actor"=>"Mila Kunis")]);

        $this->MovieController = new MovieController($movieInfo);
    }

    public function testvalidateInfo()
    {
        $movieInfo = array();
        $movieInfo[] = (object)array("name"=>"Beverly Hills Cop", "roles"=>[(object)array("name"=>"Axel Foley","actor"=>"Eddie Murphy")]);
        $movieInfo[] = (object)array("name"=>"Absolutely",        "roles"=>[(object)array("name"=>"Jenny Summers","actor"=>"Eddie Murphy")]);
        $movieInfo[] = (object)array("name"=>"",                  "roles"=>[(object)array("name"=>"Billy Rosewood","actor"=>"Judge Reinhold")]);
        $movieInfo[] = (object)array(                             "roles"=>[(object)array("name"=>"Chris Chambers","actor"=>"River Phoenix")]);
        $movieInfo[] = (object)array("name"=>"Stand By Me");
        $movieInfo[] = (object)array("name"=>"Star Trek",         "roles"=>[(object)array("name"=>"Romulan")]);
        $movieInfo[] = (object)array("name"=>"Family Guy",        "roles"=>[(object)array("actor"=>"Mila Kunis")]);

        $expectedResult = array();
        $expectedResult[] = (object)array("name"=>"Beverly Hills Cop", "roles"=>[(object)array("name"=>"Axel Foley","actor"=>"Eddie Murphy")]);
        $expectedResult[] = (object)array("name"=>"Absolutely",        "roles"=>[(object)array("name"=>"Jenny Summers","actor"=>"Eddie Murphy")]);
        $expectedResult[] = (object)array("name"=>"",                  "roles"=>[(object)array("name"=>"Billy Rosewood","actor"=>"Judge Reinhold")]);
        $expectedResult[] = (object)array("name"=>"",                  "roles"=>[(object)array("name"=>"Chris Chambers","actor"=>"River Phoenix")]);
        $expectedResult[] = (object)array("name"=>"Stand By Me",       "roles"=>[]);
        $expectedResult[] = (object)array("name"=>"Star Trek",         "roles"=>[(object)array("name"=>"Romulan","actor"=>"")]);
        $expectedResult[] = (object)array("name"=>"Family Guy",        "roles"=>[(object)array("name"=>"","actor"=>"Mila Kunis")]);

        $this->assertEquals(
            $this->MovieController->validateInfo($movieInfo),
            $expectedResult
        );
    }

    public function testgetActors()
    {
        $expectedResult = ["", "Eddie Murphy", "Judge Reinhold", "Mila Kunis", "River Phoenix"];
        $this->assertEquals(
          $this->MovieController->getActors(),
          $expectedResult
        );
    }

    public function testgetRoles()
    {
        $expectedResult = ["Absolutely"=>"Jenny Summers","Beverly Hills Cop"=>"Axel Foley"];
        $this->assertEquals(
          $this->MovieController->getRoles("Eddie Murphy"),
          $expectedResult
        );
    }

    public function testgetActorsAndRoles()
    {
        $expectedResult = [
            ""               => ["Star Trek"=>"Romulan"],
            "Eddie Murphy"   => ["Absolutely"=>"Jenny Summers","Beverly Hills Cop"=>"Axel Foley"],
            "Judge Reinhold" => [""=>"Billy Rosewood"],
            "Mila Kunis"     => ["Family Guy"=>""],
            "River Phoenix"  => [""=>"Chris Chambers"],
        ];
        $this->assertEquals(
          $this->MovieController->getActorsAndRoles(),
          $expectedResult
        );
    }
}
