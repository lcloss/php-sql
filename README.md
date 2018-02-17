# php-sql

A simple Class to work with SQL in PHP 

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

You will need a web server and PHP configured.
Also, you need to use one of these databases systems:
* MariaDB or MySql
* SQL Server
* SQLite

This project is intended to be incorporated into another project, so the minimum prerequisite is the web server, PHP and a Database driver as mentioned above.

### Installing

Installation with Git:

```
git clone https://github.com/lcloss/php-sql.git
```

Instalação com o Composer:

```
composer require lcloss/php-sql
```

## Running the tests

### Initial setup

If you are using MariaDb, MySQL or SQL Server, you need to create the database schema first.

With your data, write:

```
```

### Returning Data

```
$sql = new Sql();
$results = $sql->query("SELECT * FROM table WHERE id = :id", [
	':id'		=> 1
]);

if ( count($results) > 0 ) {
	echo 'Found!';
} else {
	echo 'Not Found...';
}
```

### Executing SQL

Type the following code:

```
$sql = new Sql();
$sql->query("UPDATE table SET name = :name WHERE id = :id", [
	':id'		=> 1,
	':name'	=> 'New name',
]);
```

## Built With

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [GitHub](https://github.com/) for versioning. For the versions available, see the [tags on this repository](https://github.com/lcloss/php-sql/tags). 

## Authors

* **Luciano Closs** - *Initial work* - [LCloss](https://github.com/lcloss)

See also the list of [contributors](https://github.com/lcloss/php-sql/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* This project was inspired by the [Curso Completo de PHP 7](https://www.udemy.com/curso-php-7-online/) from [HCode](https://www.hcode.com.br/)
* This README.md was build from [PurpleBooth README Template](https://gist.github.com/PurpleBooth/109311bb0361f32d87a2)
