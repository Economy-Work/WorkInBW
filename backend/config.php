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
        'question' => 'Pick your Gender',
        'options' => [
          'female' => 'Female',
          'male' => 'Male',
          'diverse' => 'Diverse',
          'unknown' => 'I don\'t want to disclose this'
        ]
      ],
      [
        'type' => 'date',
        'name' => 'bday',
        'question' => 'What\'s your birthday?'
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
        'video' => 'Starting.mp4'
      ],
      [
        'type' => 'text',
        'name' => 'working_bc',
        'question' => 'Why do you want to work in Baden-Württemberg?'
        'video' => 'WhyWorkHere.mp4'
      ],
      [
        'type' => 'text',
        'name' => 'strengths',
        'question' => 'What are your greatest strengths?'
        'video' => 'YourStrenghts.mp4'
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
        'video' => 'GreatestAccomp.mp4'
      ],
      [
        'type' => 'text',
        'name' => 'position',
        'question' => 'What are you looking for a new position?'
        'video' => 'Position.mp4'
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
      ]
    ]
  ],
  'job_details' => [
    'type' => 'form',
    'title' => 'Details about your profession',
    'description' => 'Tell us more about your experience',
    'questions' => [
      [
        'type' => 'select',
        'allow_multiselect' => true,
        'name' => 'jobtitle',
        'question' => 'What\'s your Job or the Job you want to exercise?',
        'extra_info' => 'More Professions will be added soon!',
        'options' => [
          'cyberSecty' => 'Cybersecurity',
          'dataMang' => 'Data Management',
          'dataScnc' => 'Data Science & AI',
          'dsgn' => 'Design',
          'alternDrive' => 'Alternative drive technologies',
          'analyChem' => 'Analytical Chemistry',
          'assAutoDrive' => 'Assist & autonomous Driving',
          'bioTech' => 'Biotechnologie',
          'electrEng' => 'Electrical Engineering',
          'industEng' => 'Industrial Engineering'
        ]
      ],
      [
        'type' => 'number',
        'name' => 'experience',
        'question' => 'How many years do you have experience in this field?'
      ],
      [
        'type' => 'select',
        'allow_multiselect' => true,
        'name' => 'skills',
        'question' => 'Please select all your Skills',
        'options' => [
          'Firewall Security System',
          'Methods information security',
          'Encryption',
          'Security Incident Handling and Response',
          'Virtual Private Networks',
          'Automated measurement',
          'Management data quality',
          'Database & Master Data Management (SQL, Data Hub)',
          'Data processing (EDP)',
          'Big Data Analytics',
          'Deep Learning (Neural Networks)',
          'Machine Learning Technologies',
          'Scikit-Learn, Tensorflow, Keras, PyTorch, Python',
          'Human-machine interaction and design user interfaces',
          'UI / UX / Interaction Design (Adobe XD)',
          'Web Frontend Development (CSS)',
          'Visualization (Illustrator)',
          'Battery development (High Voltage Battery)',
          'E Fuels',
          'Electric Powertrain Development',
          '(E-Axes, Silicon Carbide Semiconductor)',
          'Electric Engine Management Systems (EMS)',
          'Energy Storage (Lithium Ion Technology)',
          'Hydrogen / Fuel Cell',
          'Material analysis ((infrared) spectroscopy)',
          'Quality Management in the Chemical Industry (CAPA)',
          'Data specifications and processing (esp. GPS data)',
          'Development of driver assistance systems (object recognition)',
          'Functional safety (IEC, ISO, 8D)',
          'Legal requirements',
          'Standardization of the Software Architecture of Vehicles (AutoSAR)',
          'Networking (3D navigation landscape, share accidents in real time)',
          'Biochemical Analysis (Chromatography)',
          'Genome Editing (CRISPR)',
          'Molecular Biological Techniques (In Vitro)',
          'Cell cultivation',
          'Digital Electronics (Digital Circuit Technology, ASIC)',
          'Industrial Robotics (fault analysis)',
          'Laser Scanning (LIDAR)',
          'Performance Optimization (EDA)',
          'Microtechnology (Custom Chip)',
          'Automation (programmable logic controller, robotic process automation, automatic assembly)',
          'High Performance Plastic Maintenance (Preventive / Predictive Maintenance)',
          'Human-Machine Interaction and Integration',
          'Simulation & Digital Twin',
          'Technical drawing and construction (CAD, Design for Manufacturing and Assembly, 3D printing, BIM)',
          'Application systems (Microsoft Office)',
          'Operating systems (Microsoft Windows)',
          'Privacy Policy (GDPR)',
          'Coordination ability',
          'Solution orientation',
          'Structuring & Conceptualization'
        ]
      ],
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
