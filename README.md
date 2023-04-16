![](/backend/assets/img/banner.svg)
# WorkInBW

## Live Demo:
https://workinbw.com/

## About the Project:
This Project is a Web-Based Platform, which helps foreign specialized workers to find the perfect workingplace in Baden-Württemberg.
With WorkinBW, you can complete pre-hiring assessments to get matched with great local and global companies in Baden-Württemberg looking for employees!

## Used Technologies:
The Backend is made with PHP.

For the evaluation of the questions and tasks sheet we use Python and AI.

The web-app is located in the `main` branch of this repository, the python backend is located in the `intel` and `recomm` branches.

## How it works:
The worker who wants to work in Baden-Württemberg signs up and can start to fill out the question sheet.

After filling out the question sheet, the next step is to do a speaking task and after that a writing task.

After all questions and tasks, the answers get automatically evaluated, then the system tries to automatically find matching comapnies eho are looking for workers with those skills and the results are shown to the user.

Aditionally, the users are able to view a list of resources which will help them with getting started in Baden-Württemberg: The resources cover topics like work permits, visas, accomondation in BW and more.

## Running it locally:
To run the project locally, you need to have a python3 and php >= 7.4 runtime installed and setup on your system. You'll also need a running MySQL database, such as MariaDB.

First of all, you'll need to create a new MySQL database and a user with access to it. Enter the credentials into the `backend/config.php` file and import the empty databse schema (`db_schema.sql`) into your database to create the necessary tables.

To run the PHP backend, clone the Repository and either you can setup an webserver with PHP to support to run and access it, or you can go into the `backend/` directory and start a local development server:
`php -S localhost:8080`

For the AI backend to work (which evaulate the assignment answers), it is recommended to clone the repository again into a seperate directory, move into the `intel` branch, install all requirements with `pip3` and start all available python scripts. This will run the different intenal REST APIs on different local ports, so they are accessible from the PHP backend.

A live demo can be found (with the python backend working only to a limited extend because of available hardware resources) at https://workinbw.com/

~ A <a href="https://mesh-stuttgart.de/" target="_blank">MESH2023</a> Hackathon Project by  <a href="https://github.com/ridhimagarg" target="_blank">Ridhima</a>, <a href="https://github.com/akshat4112" target="_blank">Akshat</a>, <a href="https://github.com/megagmbh-mega" target="_blank">Felix</a> and <a href="https://github.com/anthemaker" target="_blank">Anton</a.