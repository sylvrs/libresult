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
 * @template TValue of mixed
 *
 * @extends Result<TValue, null>
 */
final class Ok extends Result {

	/**
	 * @param TValue $value
	 */
	public function __construct(private mixed $value) {
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