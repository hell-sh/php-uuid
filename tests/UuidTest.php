<?php
require __DIR__."/../vendor/autoload.php";
use hellsh\UUID;
final class UuidTest extends \PHPUnit\Framework\TestCase
{
	function testEquality()
	{
		$uuid1 = new UUID("e0603b592edc45f7acc7b0cccd6656e1");
		$uuid2 = new UUID("e0603b59-2edc-45f7-acc7-b0cccd6656e1");
		$this->assertEquals($uuid1, $uuid2);
	}

	function testToString()
	{
		$uuid = new UUID("e0603b592edc45f7acc7b0cccd6656e1");
		$this->assertEquals("e0603b592edc45f7acc7b0cccd6656e1", $uuid->toString());
		$this->assertEquals("e0603b59-2edc-45f7-acc7-b0cccd6656e1", $uuid->toString(true));
	}

	function testGeneratev5()
	{
		$this->assertEquals("a36e854defad58cdbd0084259b83901d", UUID::v5("Hello, world!")->toString());
	}
}
