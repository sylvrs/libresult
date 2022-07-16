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