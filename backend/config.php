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
        'question' => 'Tell me something about yourself.',
        'video' => 'Starting.mp4'
      ],
      [
        'type' => 'text',
        'name' => 'working_bc',
        'question' => 'Why do you want to work in Baden-Württemberg?',
        'video' => 'WhyWorkHere.mp4'
      ],
      [
        'type' => 'text',
        'name' => 'strengths',
        'question' => 'What are your greatest strengths?',
        'video' => 'YourStrengths.mp4'
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
        'question' => 'What is your greatet accomplishment?',
        'video' => 'GreatesAccomp.mp4'
      ],
      [
        'type' => 'text',
        'name' => 'position',
        'question' => 'What are you looking for a new position?',
        'video' => 'Position.mp4'
      ],
      [
        'type' => 'text',
        'name' => 'prof_achiv',
        'question' => 'What is the professional achievment you\'re most proud of?'
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
        'question' => 'To assess your talking skills, please talk 3 minutes about the following topic:',
        'topics' => [
          'Are you good at art?',
          'Did you learn art at school when you were child.',
          'Is art popular in your country, if yes what kind of art?',
          'Did you enjoy your childhood?',
          'What did you enjoy doing as a child?',
          'Did you have lots of friends when you were child?',
          'Are clothes important to you?',
          'What kind of clothes do you usually wear?',
          'Do most of the people in your country follow fashion?',
          'Are you a happy person?',
          'What makes you usually happy or unhappy?',
          'Does the weather ever affect how you feel?',
          'Do you think people in your country are generally happy people?',
          'How do you usually get your news?',
          'What kind of news do you usually follow?'
        ]
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
        'question' => 'To assess your writing an grammar skills, please write about ~500 words about the following topic:',
        'topics' => [
          'Some people think that government is wasting money on the arts  and this money can be utilized in a better way. What do you think?',
          'Most artists earn low salaries and should therefore receive funds from government to continue with their work. To what extent do you agree?',
          'Companies should provide sports and social facilities for local communities. What do you think?',
          'What are the advantages and disadvantages for both individuals and companies to shopping online? To what extent do you agree?',
          'marketing and promotion is the key to a successful business? What do you think?',
          'Some people think that only way to have success in business is to have a unique product. What do you think?',
          'Some people think that women should not be allowed to work in the police force. What do you think?',
          'More people believe that having a fixed punishment for all crimes is more efficient. What is your opinion on this.?',
          'Some people think that poverty is the reason behind most crimes. To what extent do you agree?',
          'The best way to improve health is to exercise daily. What do you think?',
          'Doctors should be responsible for educating their patients about how to improve health. Do you agree with this?',
          'Scientist predict that all people will choose to talk the same global language in the future. DO you think this is a positive or negative development?',
          'Finding job satisfaction is considered to be a luxury in many developing countries. What do you think that is? Do you think job satisfaction is important?',
          'Having a good university degree guarantees people a good job? To what extent you agree?',
          'Globalization has both advantages and disadvantages. Discuss both and give your opinion?'
        ]
      ]
    ]
  ],
  'personality' => [
    'type' => 'form',
    'title' => 'Personality Test',
    'description' => 'Answer some personality-based questions',
    'extra_info' => 'Please enter values between 1 and 8. Which aspects apply to you? 1 is lowest, 8 is highest.',
    'questions' => [
      [
        'type' => 'number',
        'min_value' => 1,
        'max_value' => 8,
        'name' => 'openness',
        'question' => 'OPENNESS - OPEN TO TRYING NEW THINGS'
      ],
      [
        'type' => 'number',
        'min_value' => 1,
        'max_value' => 8,
        'name' => 'neuroticism',
        'question' => 'NEUROTICISM - EMOTIONAL INSTABILITY'
      ],
      [
        'type' => 'number',
        'min_value' => 1,
        'max_value' => 8,
        'name' => 'conscientiousness',
        'question' => 'CONSCIENTIOUSNESS - SELF-DISCIPLINE'
      ],
      [
        'type' => 'number',
        'min_value' => 1,
        'max_value' => 8,
        'name' => 'agreeableness',
        'question' => 'AGREEABLENESS - CARING ABOUT OTHERS'
      ],
      [
        'type' => 'number',
        'min_value' => 1,
        'max_value' => 8,
        'name' => 'extraversion',
        'question' => 'EXTRAVERSION - HOW MUCH SOCIAL YOU ARE'
      ]
    ]
  ]
];
