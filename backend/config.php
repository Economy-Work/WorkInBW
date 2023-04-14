<?php

$interview_steps = [ // subject to change
  'details' => [
    'type' => 'form',
    'title' => 'General details about your Profession',
    'questions' => [
      [
        'type' => 'text',
        'question' => 'What\'s your Job description?'
      ],
      [
        'type' => 'number',
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
        'question' => 'Personality question 1 goes here'
      ],
      [
        'type' => 'text',
        'question' => 'Personality question 2 goes here'
      ]
    ]
  ]
];
