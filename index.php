<?php

/**
* Lottery Game Project For The PHP Beginner
* who had experienced in conditional statement, iteration, function, data type casting and I/O
* LICENSE - MIT
* I apperiate your contributing but don't make pull request because this code is aimed for the tutorials of Facebook Page - @webdevenv (Programming 101 Playlist - Web Dev Environment You Tube Channel)
*/

include_once 'helper.php';

// seed the later executing random function
srand(time() * 1000000);

echo "Welcome From Lottery Game!\n";

$correctNumber = correctNumber();

$legalAge = 18;
$legalIdNumber = 123456; // id number for security
$guessingNumber = 0;
$totalMoney = 0; // total money from user
$gumbblerMoney = 0; // gumbbler money for each guessing number
echo "$correctNumber \n";

$age = readline("Enter your age : "); // get the age from user

if ($age < 18) {
  message("Leave from this game and delete from your machine");
}

// validate age
while ($age >= $legalAge) {
  // validate userid
  $userId = (int) readline("Enter your ID number : ");

  while ($userId === $legalIdNumber) {
    // collect money from user
    $totalMoney = (int)readline("Enter total money from 1000 : ");

    if ($totalMoney < 1000) {
      message("You don't enough money!\n");
    }

    while ($totalMoney >= 1000) {
      // get user guessing data
      $guessingNumber = (int)readline("Enter your guessing number between 000 to 999 : ");

      // get $gumbblerMoney for previus guessing number
      $gumbblerMoney = (int) readline("Enter your gubbler money (<=1000) : ");

      if ($gumbblerMoney < 1000) {
        echo "Gummbling money must be greater than 1000\n";
      }

      if ($guessingNumber === $correctNumber) {
        echo "Congrat! You win ><\n";
        $bonusMoney = $gumbblerMoney * 5;
        $totalMoney += $bonusMoney;
        echo "You win $bonusMoney\n";
        echo "Your total money = $totalMoney\n";

        // game state
        $isPlaying = readline("Do you want to play? [Y/N] : ");
        switch ($isPlaying) {
          case 'Y':
            $correctNumber = correctNumber();
            echo "You are still playing ><\n";
            break;
          case 'N':
            message("Bye Bye!!");
            break;
        }
      } else {
        // reduce total money depned on $gumbblerMoney
        $totalMoney -= $gumbblerMoney;

        // if $totalMoney < 1000
        if ($totalMoney < 1000) {
          echo "Your total money is $totalMoney \n";
          message("You don't enough money! Fill your pocket and try again later :(");
        }
        // generate new number
        $correctNumber = correctNumber();
        echo "You Lose! Your total money is $totalMoney \n";
      }
    }
  }
}