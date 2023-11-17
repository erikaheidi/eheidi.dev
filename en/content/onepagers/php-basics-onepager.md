---
title: PHP Basics for the Command Line
description: A light introduction to the PHP language and its general syntax focused on the command line 
tags: coding, beginners
---
PHP is an interpreted programming language that primarily runs on the command line, with additional software that allows it to serve content to web servers. A web server, such as Nginx, will make requests to a PHP service running either locally or on a remote location (such as, another server or container) in order to obtain the contents that should be made available to the user who originally requested the server's URL.

With a modest learning curve and an extensive user-land ecosystem of community packages, PHP is an excellent choice for building command-line tools that can be used to query APIs, parse and generate content, talk with databases, and many other tasks that don't require a graphic interface. PHP CLI apps can run on schedule as cron jobs and as GitHub Actions.

Even if your end goal is learning PHP to create web applications, limiting the scope initially to command line PHP will help you focus on the language syntax and specific constructions before having to deal with front-end and web requests.

In this _crash_ course, you'll learn the basics about PHP programming for the command line.

## Running PHP Code

Before you're able to run any PHP code, you'll need to set up a PHP development environment. There are many ways to go about that, but for this mini course we'll use Docker, because it is multi-platform, and it allows you to run PHP code without having to install a PHP environment on your local machine.

If you haven't yet, now is a good time to get Docker installed on your system. If you are on Linux, you have the choice to install either the [Docker Engine](https://docs.docker.com/engine/install/), which is a minimalist way to get Docker up and running on your system, or [Docker Desktop](https://docs.docker.com/desktop/), which offers a graphic interface to operate Docker. Windows and macOS users need to install [Docker Desktop](https://docs.docker.com/desktop/).

Follow the installation instructions for your operating system. Then, confirm that you can run `docker` on the command line:

```shell
docker --version
```
You can now pull a PHP development image to execute your PHP code. I recommend [Chainguard Images](https://edu.chainguard.dev/chainguard/chainguard-images/reference/php) because they're minimal and always up-to-date with the latest patches for bugs and CVEs.

To pull the image locally, run:

```shell
docker pull cgr.dev/chainguard/php:latest-dev
```

```shell
docker run cgr.dev/chainguard/php:latest-dev --version
```
```
PHP 8.2.12 (cli) (built: Oct 24 2023 23:44:54) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.2.12, Copyright (c) Zend Technologies
```

You should now be ready to execute PHP scripts on the command line.

## Files and Execution

PHP scripts are typically defined in `.php` files, although when working in the command line you may have PHP executables without an extension, just like with bash scripts. The PHP interpreter ignores anything that is outside a `<?php` block.

The recommended practice is to **not** mix PHP code with other types of content, having the opening `<?php` tag at the very beginning of the file and not adding a closing tag, which will enforce that all contents in the file should pass through the PHP interpreter. The exception is for CLI executables, which can start with a shebang before the opening PHP tag to indicate that the PHP interpreter should be used to run the code defined in that file:

```php
#!/usr/bin/env php
<?php
//php code starts here
```

In PHP, code instructions are delimited by a `;`. Indentation doesn't change code correctness (such as in Python, for instance), but it is naturally a good practice to keep your code organized by using proper indentation.

## Variables and Types

Variables in PHP are preceded with a `$` sign and can be of many different types, although PHP is not a typed language by default: regular variables are dynamically typed (which means you don't need to define the variable type beforehand, like in some other languages). Variable types are most often inferred at runtime from the value assigned to them, and also don't require memory allocation.

That being said, PHP **has** a typing system designed to set expectations about what kind of variable is assigned to a property, or passed as parameter to functions and methods. We'll talk about this in a later part of this crash course; for now, you don't need to worry about types too much.

```php
<?php
$test = "this is a string";
$number = 1337;
$combined = "The number is $number";
```

### Built-in Types

- **string**: a series of characters enclosed by single or double quotes. Using double quotes is required for parsing any variables inside the string; for example: "the number is $number" will replace `$number` by its value, whereas 'the number is $number' won't parse the variable and instead print strictly what's inside the `''`.
- **array**: arrays are indexed collections of variables that can have mixed types and support nesting in several levels. If you're familiar with _JSON_ data, you can visualize arrays as a structured, iterable JSON. Indexes can be auto-assigned (int) and start at `0`. Indexes can also be defined as strings.
- **int**: Integer numbers.
- **float**: Numbers with floating point.
- **bool**: Either `true` or `false`.
- **null**: A variable that hasn't been initialized has its value set to "null". You'll often use this in comparisons, to confirm whether a value is set or not.
- **resource**: This is a special type used for resources such as file pointers.
- **object**: An object instantiated from a PHP class.

It's worth noting that variables are cast automatically to other types when mixed in operations, depending on the types and operators used.

```php
$a = 6; //this is an integer
$b = "6"; //this is a string
```

## Code Comments

In a PHP file, any portion of code preceded with a `#` or `//` will be ignored until there's a line break. For multi-line comments, you should use a `/* comment */` block.

```php
# this is a single line comment
// this is also a single line comment
$a = 1;
echo $a; //comments can come anywhere
/*
  this is a multi-line comment
  can have multiple lines
 */
```

## Operators
Operators, as the name suggests, are special characters that allow you to perform operations with different values and variables.

### Arithmetic Operators

| | Operation            | Example              |
| --- |----------------------|----------------------|
| `=` | attribution          | `$a = 5;` // 5       |
| `+` | sum                  | `$a = 5 + 5;`  // 10 |
| `-` | subtraction          | `$a = 10 - 5;` // 5  |
| `*` | multiplication       | `$a = 5 * 2;` // 10  |
| `/` | division             | `$a = 10 / 2;` // 5  |
| `%` | module from division | `$a = 11 % 2;` // 1  |

### String Operators

| | Operation                     | Example                 |
|--|-------------------------------|-------------------------|
| `.` | string concatenation          | `$a = $str1 . " text";` |
| `.=` | concatenation and attribution | `$a .= "suffix"`         |

### Comparison Operators
Comparison operators are typically used within conditionals to test values in a variable.

| | Operator                          | Example             |     
|---------|-----------------------------------|---------------------|
| `==`            | equals (non-strict)               | `5 == 5` //true     |
| `!=` | not equals (non-strict)           | `5 != 5` //false |
| `===` | strict equals (value AND type)    | `"6" === 6` //false |
| `!==` | strict not equals (value OR type) | `"6" !== 6` // true |
| `>` | more than                         | `6 > 5` //true      |
| `<` | less than                         | `6 < 5` //false     |
| `>=` | more than or equal to             | `6 >= 6` //true     |
| `<=` | less than or equal to             | `6 <= 5` //false    |

### Logical Operators
These operators are typically used within conditionals to "short-circuit" the execution flow of a script.

| | Operator         | Examples   |
|-----|------------------|---------|
| `!` | Logical invert   | `!true` //false  |
| `&&`, `AND` | logical **and**  | `true && true` //true<br />`true && false` //false |
| `\|\|`, `OR` | logical **or**   | `true && true` //true<br/>`true && false` //true |

It is easier to understand logical operators after you get familiar with conditionals, which we'll cover in the next section.

## Conditionals
Conditionals allow you to test for values and change the flow of your code depending on the result of a logical expression.

### `if` / `else` / `elseif`

```php
<?php
$test = 1;
if ($test > 0) {
  echo "condition is met";
} else if ($test == 1) {
  echo ""
}
```

### `match`

### `switch`

## Loops
Loops allow you to repeat a portion of code, typically until a certain condition is met - although in the command line you can have infinite loops that keep the application running until an interruption signal is received.

In PHP, we have the following looping structures: `for`, `foreach`, `while`, and `do-while`.

### `for`

### `foreach`

### `while`

### `do-while`

### Flow Control: `continue`, `break`, and `return`

## Functions
Functions are blocks of code that can be reused across the application, accepting variable parameters, and may or may not return a value.

```php
function greet(string $name): void
{
    echo "Hello $name!";
}
```

It is possible to define default values for function parameters. When using this feature, any parameters that don't have a predefined value must come before the parameters with default values, for example:

```php
function greet(string $name, string $greeting = "Hello"): void
{
    echo "$greeting $name!";
}
```
