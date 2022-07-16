<?php
/**
 *  _ _ _                         _ _
 * | (_) |                       | | |
 * | |_| |__  _ __ ___  ___ _   _| | |_
 * | | | '_ \| '__/ _ \/ __| | | | | __|
 * | | | |_) | | |  __/\__ \ |_| | | |_
 * |_|_|_.__/|_|  \___||___/\__,_|_|\__|
 *
 * This library is free software licensed under the MIT license.
 *
 * Copyright (c) 2022 Matthew Jordan
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