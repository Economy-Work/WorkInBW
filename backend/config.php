<?php

$interview_steps = [ // subject to change
  'details' => [
    'type' => 'form',
    'title' => 'General details about your Profession',
    'questions' => [
      [
        'type' => 'text',
        'name' => 'desc',
        'question' => 'What\'s your Job description?'
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
