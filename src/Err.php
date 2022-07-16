<?php
declare(strict_types=1);

namespace libresult;

/**
 * @template TError of mixed
 *
 * @extends Result<null, TError>
 */
final class Err extends Result {

	/**
	 * @param TError $error
	 */
	public function __construct(public mixed $error) {
		parent::__construct();
	}

	/**
	 * @return TError
	 */
	public function getError(): mixed {
		return $this->error;
	}

	/**
	 * @return null
	 */
	public function get(): mixed {
		return null;
	}

	/**
	 * @return array{null, TError}
	 */
	public function asArray(): array {
		return [null, $this->error];
	}
}