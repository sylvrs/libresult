<?php
/**
 *
 * Copyright (C) 2020 - 2022 | Matthew Jordan
 *
 * This program is private software. You may not redistribute this software, or
 * any derivative works of this software, in source or binary form, without
 * the express permission of the owner.
 *
 * @author sylvrs
 */
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