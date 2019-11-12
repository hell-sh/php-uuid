<?php
require_once __DIR__."/../vendor/autoload.php";
use hellsh\UUID;
class UuidTest
{
	function testEquality()
	{
		$uuid1 = new UUID("e0603b592edc45f7acc7b0cccd6656e1");
		$uuid2 = new UUID("e0603b59-2edc-45f7-acc7-b0cccd6656e1");
		Nose::assert($uuid1 == $uuid2);
	}

	function testToString()
	{
		$uuid = new UUID("e0603b592edc45f7acc7b0cccd6656e1");
		Nose::assertEquals($uuid->toString(), "e0603b592edc45f7acc7b0cccd6656e1");
		Nose::assertEquals($uuid->toString(true), "e0603b59-2edc-45f7-acc7-b0cccd6656e1");
	}

	function testGeneratev5()
	{
		Nose::assertEquals(UUID::v5("Hello, world!")->toString(), "9112042407e0506ca6a4726e89871b72");
	}
}
