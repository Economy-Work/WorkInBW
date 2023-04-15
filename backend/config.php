<?php
session_start();

/*
// DEBUGGING
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
*/

// connect to local mysql database
$pdo = new PDO('mysql:host=localhost:3306;dbname=workinbw', 'workinbw', 'helloworld123'); // TODO: save password as ENV secret (and change it)

$interview_steps = [ // subject to change
  'details' => [
    'type' => 'form',
    'title' => 'General details about your Profession',
    'questions' => [
      [
        'type' => 'select',
        'name' => 'gender',
        'question' => 'Pick your Gender?'
      ],
      [
        'type' => 'date',
        'name' => 'bday',
        'question' => 'When are you born?'
      ],
      [
        'type' => 'text',
        'name' => 'nationality',
        'question' => 'Which nationality do you have?'
      ],
      [
        'type' => 'select',
        'name' => 'jobtitle',
        'question' => 'What\'s your Job or the Job you want to exercise?'
      ],
      [
        'type' => 'number',
        'name' => 'experience',
        'question' => 'How many years do you have experience in this field?'
      ]
    ]
  ],
  'speaking' => [
    'type' => 'form',
    'title' => 'Speaking Test',
    'questions' => [
      [
        'type' => 'voice',
        'name' => 'speaking',
        'question' => 'Text to read out loud goes here'
      ]
    ]
  ],
  'writing' => [
    'type' => 'form',
    'title' => 'Writing Test',
    'questions' => [
      [
        'type' => 'textarea',
        'name' => 'writing',
        'question' => 'Topic to write about goes here'
      ]
    ]
  ],
  'personality' => [
    'type' => 'form',
    'title' => 'Personality Test',
    'questions' => [
      [
        'type' => 'text',
        'name' => 'pers1',
        'question' => 'Personality question 1 goes here'
      ],
      [
        'type' => 'text',
        'name' => 'pers2',
        'question' => 'Personality question 2 goes here'
      ]
    ]
  ]
];
