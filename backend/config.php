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
    'title' => 'General details about yourself',
    'description' => 'Enter your basic information to get started',
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
      ]
    ]
  ],
  'personal' => [
    'type' => 'form',
    'title' => 'Getting to know you',
    'description' => 'Tell us more about yourself and what you are looking for',
    'questions' => [
      [
        'type' => 'text',
        'name' => 'tell_yourself',
        'question' => 'Tell me something about yourself.'
      ],
      [
        'type' => 'text',
        'name' => 'working_bc',
        'question' => 'Why do you want to work in Baden-Wuertemberg?'
      ],
      [
        'type' => 'text',
        'name' => 'strengths',
        'question' => 'What are your greatest strengths?'
      ],
      [
        'type' => 'text',
        'name' => 'strgt_weaks',
        'question' => 'What are your strengths and your weaknesses?'
      ],
      [
        'type' => 'text',
        'name' => 'want_to_know',
        'question' => 'What do you want to know about the company or organization'
      ],
      [
        'type' => 'text',
        'name' => 'why_hire',
        'question' => 'Why should we hire you?'
      ],
      [
        'type' => 'text',
        'name' => 'greatest_accomp',
        'question' => 'What is your greatet accomplishment?'
      ],
      [
        'type' => 'text',
        'name' => 'position',
        'question' => 'What are you looking for a new position?'
      ],
      [
        'type' => 'text',
        'name' => 'prof_achiv',
        'question' => 'What is the professional achievment you`r most proud of?'
      ],
      [
        'type' => 'text',
        'name' => 'work_envi',
        'question' => 'What kind of working enviroment do you work the best?'
      ],
      
      // here go the other questions
    ]
  ],
  'job_details' => [
    'type' => 'form',
    'title' => 'Details about your profession',
    'description' => 'Tell us more about your experience',
    'questions' => [
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
    'description' => 'Test how well you can speak German',
    'questions' => [
      [
        'type' => 'video',
        'name' => 'speaking',
        'question' => 'Text to read out loud goes here'
      ]
    ]
  ],
  'writing' => [
    'type' => 'form',
    'title' => 'Writing Test',
    'description' => 'Tets how well you can write in German',
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
    'description' => 'Answer some personality-based questions',
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
