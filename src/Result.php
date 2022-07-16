<?php
declare(strict_types=1);

namespace libresult;

use RuntimeException;

/**
 * This is the base class for both Ok and Err. It should only be used as a return type.
 *
 * @template TValue of mixed
 * @template TError of mixed
 */
abstract class Result {

	public function __construct() {
		// This is a workaround for PHP's lack of support for sealed classes
		if (!$this instanceof Ok && !$this instanceof Err) {
			throw new RuntimeException("Result cannot be extended. Please use Ok or Err.");
		}
	}

	/**
	 * Attempts to get the value of the result. Returns null if a value is not present.
	 *
	 * @return TValue|null
	 */
	public abstract function get(): mixed;

	/**
	 * Attempts to return the value of the result. If the value is not present, returns the value of `$default`.
	 *
	 * @param mixed $default
	 * @return mixed
	 */
	public function getOr(mixed $default): mixed {
		return $this->get() ?? $default;
	}

	/**
	 * Attempts to unwrap the result into a value. If the result is an `Err`, throws an exception.
	 *
	 * @return TValue
	 */
	public function unwrap(): mixed {
		return match (true) {
			$this instanceof Ok => $this->getValue(),
			default => throw new RuntimeException("Expected Ok, got Err")
		};
	}

	/**
	 * Attempts to unwrap the error of the result. If the result is not an `Err`, throws an exception.
	 *
	 * @return TError
	 */
	public function unwrapError(): mixed {
		return match (true) {
			$this instanceof Err => $this->getError(),
			default => throw new RuntimeException("Expected Err, got Ok")
		};
	}

	/**
	 * Returns an array that can be destructured to get the value and error.
	 *
	 * @return array{TValue|null, TError|null}
	 */
	public abstract function asArray(): array;
}