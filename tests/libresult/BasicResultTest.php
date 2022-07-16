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

use Exception;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class BasicResultTest extends TestCase {

	public function testBasicValue(): void {
		$result = $this->generateRandomOk();
		$value = match (true) {
			$result instanceof Ok => $result->getValue(),
			$result instanceof Err => throw new RuntimeException("Expected Ok, got Err"),
			// This will NEVER happen, but it's here to make PHPStan happy
			default => assert(true),
		};
		$this->assertIsInt($value);
	}

	public function testBasicError(): void {
		$result = $this->generateErr();
		$value = match (true) {
			$result instanceof Ok => throw new RuntimeException("Expected Ok, got Err"),
			$result instanceof Err => $result->getError(),
			// This will NEVER happen, but it's here to make PHPStan happy
			default => assert(true),
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
				return [1, 2];
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