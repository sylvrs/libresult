# libresult
This library is a PHP-based implementation of the `Result` monad that exists in many popular programming languages, including Haskell, Elm, Kotlin, and Rust.

## Installation
To install this library using Composer, run the following command:
`composer require sylvrs/libresult`

## Usage
The usage of the library follows similar standards to that of monads in other languages.

### Creating a result
The basic creation of a result is as follows:
```php
/**
 * @return Result<string, string>
 */
function create_result(): Result {
    return mt_rand(0, 1) > 0 ? new Ok("success!") : new Err("error!");
}
$result = create_result();
```

### Value Extraction
From there, there are several ways to get the values from the result:
```php
// Using PHP's match expression
$value = match (true) {
    $result instanceof Ok => $result->getValue(),
    $result instanceof Err => $result->getError(),
};

// Using `Result->get()`
// Note: This will return null if the result is an error
$value = $result->get();

// Using `Result->unwrap()`
// Note: This will throw an exception if the result is an error
$value = $result->unwrap();
```


### Useful Methods
Furthermore, there are other methods that may prove useful for working with results:
```php
// Using `Result->asArray()`
// If the result is Ok, the array shape is [TValue, null]. Otherwise, the array shape is [null, TError]
[$value, $error] = $result->asArray();

// Using `Result->getOr()`
$value = $result->getOr("default value");
```

### Error Handling
For cases where you know that the result is an error, you can use `Result->unwrapError()`:
```php
// Note: If the result is *not* an error, this will throw an exception
$error = $result->unwrapError();
```

## Issues / Feature Requests
Any issues or requests should be reported [here](https://github.com/sylvrs/libresult/issues).