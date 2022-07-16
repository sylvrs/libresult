<?php
declare(strict_types=1);

namespace libresult;

/**
 * @template TValue of mixed
 *
 * @extends Result<TValue, null>
 */
final class Ok extends Result {

	/**
	 * @param TValue $value
	 */
	public function __construct(public mixed $value) {
		parent::__construct();
	}

	/**
	 * @return TValue
	 */
	public function getValue(): mixed {
		return $this->value;
	}

	/**
	 * @return TValue
	 */
	public function get(): mixed {
		return $this->value;
	}

	/**
	 * @return array{TValue, null}
	 */
	public function asArray(): array {
		return [$this->value, null];
	}
}