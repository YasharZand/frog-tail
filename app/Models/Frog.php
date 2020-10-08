<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frog extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','upadted_at'];


    public function __construct(array $attributes = array())
    {
        //Create a Random Frog
        parent::__construct($attributes);
        $genders = ['F','M'];
        //Introvert and Extrovert
        $energies = ['I','E'];
        //based on the Cognetive Stack (MBTI)
        $cognitive_stack = ['NT','TN','FN','NF','ST','TS','FS','SF'];
        $this->gender = $genders[mt_rand(0, 3)/2]; //Better distribution: select 4 / 2
        //Generate a random name based on being a Female, or Male
        $this->name = $this->genNames($this->gender);
        $this->energy = $energies[mt_rand(0, 3)/2];
        $this->age = 0;
        $this->cog = $cognitive_stack[mt_rand(0, 7)];
        //Can have a lifespan between 10 to 15 years
        $this->lifespan = mt_rand(10, 15);
    }

    public function simulation()
    {
        return $this->belongsTo('App\Models\Simulation');
    }

    public function genNames($gender)
    {
        $males=[
            'Christopher',
            'Ryan',
            'Ethan',
            'John',
            'Anjolaoluwa',
            'Konstantin',
            'Benaiah',
            'Tremayne'
        ];
        $females=[
            'Angelita',
            'Violeta',
            'Luiza',
            'Fabiana',
            'Jayda',
            'Zoey',
            'Sarah',
            'Michelle',
            'Samantha',
        ];
        if ($gender === 'F') {
            return $females[mt_rand(0, sizeof($females) - 1)];
        } else {
            return $males[mt_rand(0, sizeof($males) - 1)];
        }
    }
}
