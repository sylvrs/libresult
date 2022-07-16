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

	public function testBasicValue(): void {
		$result = $this->generateRandomOk();
		$value = match (true) {
			$result instanceof Ok => $result->getValue(),
			$result instanceof Err => throw new RuntimeException("Expected Ok, got Err"),
		};
		$this->assertIsInt($value);
	}

	public function testBasicError(): void {
		$result = $this->generateErr();
		$value = match (true) {
			$result instanceof Ok => throw new RuntimeException("Expected Ok, got Err"),
			$result instanceof Err => $result->getError(),
		};
		$this->assertIsString($value);
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
	 * @return Result<int, string>
	 */
	private function generateRandomOk(): Result {
		return new Ok(mt_rand(0, 100));
	}

	/**
	 * @return Result<int, string>
	 */
	private function generateErr(): Result {
		return new Err("uh, oh!");
	}
}