## Installation use git bash terminal
git clone https://github.com/pramudyaazziz/mysched.git
cd mysched
copy env file and rename to .env => "cp env .env"
open .env file and setup database
php spark migrate
php spark serve
