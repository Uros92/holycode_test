# About application
- Application for fetching and merging data from Youtube and Wikipedia
- Youtube results are cached
 
## Technologies
- Lumen v.5.8

### Installation:

- git clone https://github.com/Uros92/holycode_test
- cd holycode_test/
- Make copy of file from root project .env.example and rename it to .env and paste to root of project: **cp .env.example .env**
- composer install
- Open terminal in root project and call next command **php -S localhost:8000 -t public**
- Open application in browser **localhost:8000**


#### Api endpoints
- http://localhost:8000/countries
- http://localhost:8000/countries?limit=1&offset=4


##### Test api endpoint console command (test for 200 status code and json structure) (endpoint: http://localhost:8000/countries)
- vendor/bin/phpunit --filter=testApi
