


## Scratchpay code challenge

The project goal is to build an API that's queryable via HTTP and via Pub/Sub. The API will take a UTC date as an input and an integer that will represent an amount of business days past the date after which the settlement will reach the bank account.


## Libraries and tools used
- **[Framework: Larvael]()**
- **[Test: Laravel test Feature]()**
- **[Datetime: Carbon with an adapter pattern to help switch to another library without pain]()**
- **[Pub/sub: Redis pub/sub]()**


## Holidays used are provided by
- **[https://www.interstatecapital.com/us-bank-holidays/](https://www.interstatecapital.com/us-bank-holidays/)**
- **[https://www.officeholidays.com/countries/usa/2018](https://www.officeholidays.com/countries/usa/2018)**


## Set-up instructions
1 -/ Clone the project from Bitbucket's repository https://bitbucket.org/borisclaude/scratchpaysettlement/src/master/
 
```
    $ git clone https://bitbucket.org/borisclaude/scratchpaysettlement.git
```

2 -/ After cloning done, go into the project's root folder to install project dependencies :

```
    $ cd scratchpaysettlement
    $ composer install
```

3 -/ Inside the project's root folder, copy file **.env.example** to **.env** in order to set environment file for the Laravel project :

On Linux

```
    $ cp -a .env.example .env
```

On Windows

```
    > copy .env.example .env
```

4 -/ After that, generate an app key with the command :

```
    $ php artisan key:generate
```

5 -/ Then you can run the app with :

```
    $ php artisan serve
```

6 -/ Check the running app on [http://localhost:8000](http://localhost:8000)


## Run tests

Challenge's test file is located at **tests/Feature/SettlementDateTest.php**

To run tests, go to the project's root folder and execute

```
    > vendor\bin\phpunit
```