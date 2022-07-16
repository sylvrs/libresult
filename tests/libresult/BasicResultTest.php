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

use PHPUnit\Framework\TestCase;
use RuntimeException;

class BasicResultTest extends TestCase {

	/**
	 * @throws \Exception
	 */
	public function testBasicResult(): void {
		$result = $this->generateTestResult();
		/** @var int|null $value */
		$value = match (true) {
			$result instanceof Ok => $result->getValue(),
			$result instanceof Err => throw new \Exception("Result is an Err: {$result->getError()}"),
		};
		$this->assertIsInt($value);
	}

	public function testErrorOnExtend(): void {
		$this->expectException(RuntimeException::class);
		$new = new class extends Result {
			public function get(): mixed {
				return null;
			}

			public function asArray(): array {
				return [];
			}
		};
	}

	/**
	 * @group skip
	 *
	 * @return Result<int, string>
	 */
	protected function generateTestResult(): Result {
		$value = mt_rand(min: 1, max: 2);
		return $value <= 1 ? new Ok($value) : new Err("Randomly generated error");
	}

}