<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Rych\Random\Random;

use joshtronic\LoremIpsum;

class PracticeController extends Controller
{

    /**
    *
    */
    public function example6() {
        $numberOfUsers = 5;
        $count = 0;
        for ($j = 0; $j < 8; $j++){
            $gen = new \RandomUser\Generator();
            $user = $gen->getUser();
            if($count==$numberOfUsers){
                break;
            } else {
                if(ctype_alpha ( $user->getFirstName() )){
                    echo $user->getFirstName(). ' ';
                    $count++;
                } else{
                    continue;
                }
                echo $user->getLastName() . ', ';
                echo $user->getGender() . ', ';
                echo $user->getDateOfBirth() . ', ';
                echo $user->getUsername() . ', ';
                echo $user->getSalt() . '<br>';
            }
        }
    }

    /**
    *
    */
    public function example5() {
        $lipsum = new LoremIpsum();
        echo '3 words: ' . $lipsum->words(3) . "---------";
        echo '1 sentence:  ' . $lipsum->sentence() . "-------";
        echo '2 paragraphs: ' . $lipsum->paragraphs(2) . "+++";
    }
    /**
    *
    */
    public function example4() {
        $random = new Random();
        $soRandom = new Random();
        return $random->getRandomString(8)." ".$soRandom->getRandomInteger(100, 1000);
    }
    /**
    *
    */
    public function example3() {
        echo \App::environment();
        echo 'App debug:  '.config('app.debug');
    }
    /**
    *
    */
    public function example2() {
        $fruits = ['pineapple', 'orange', 'kiwi'];
        dd($fruits);
    }

    /**
    *
    */
    public function example1() {
        return 'This is the example 1';
    }

    //
}
