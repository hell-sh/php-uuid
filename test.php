<?php
require_once "vendor/autoload.php";
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

	function testHashCode()
	{
		Nose::assertEquals((new UUID("ca18ef03-54bb-4ee9-bdfa-2245dae34e4e"))->hashCode(), -105198111);
		Nose::assertEquals((new UUID("4441f9e9-0458-4e2b-b00d-9567fbfc5bda"))->hashCode(), 199784831);
		Nose::assertEquals((new UUID("5b82720b-2346-4557-b2a8-bf7867ca74fa"))->hashCode(), -1381565218);
		Nose::assertEquals((new UUID("23a0e14d-309f-40ea-8d91-a0a26c66cf8d"))->hashCode(), -221720952);
		Nose::assertEquals((new UUID("3a4aeff2-72cb-4312-94ed-3026df8c9ff3"))->hashCode(), 65012533);
		Nose::assertEquals((new UUID("0b016f3a-b369-48ad-9491-ecd8893cf291"))->hashCode(), -1513801250);
		Nose::assertEquals((new UUID("d42e3904-fd6b-4b36-9495-67ed3fc30da1"))->hashCode(), -2112677762);
		Nose::assertEquals((new UUID("13d1264f-d60a-4a0f-a46d-0a1b450b486d"))->hashCode(), 616377910);
		Nose::assertEquals((new UUID("48d7b3b0-584f-4e4c-b5cc-68fafdc095ae"))->hashCode(), 1486094504);
		Nose::assertEquals((new UUID("a6d772a5-d9ef-4a03-a5da-4e903bddc376"))->hashCode(), -515918528);
		Nose::assertEquals((new UUID("bdf17443-5fb9-4faa-8dbd-6284cdaf2ea3"))->hashCode(), -1571129394);
		Nose::assertEquals((new UUID("0f60d424-3f43-462f-a5af-3fabfed73d3a"))->hashCode(), 1801162906);
		Nose::assertEquals((new UUID("781ec375-daff-40ad-ad2c-378f79e7ca50"))->hashCode(), 1982496263);
		Nose::assertEquals((new UUID("61affab1-8b14-4a8d-af9c-5c568783f273"))->hashCode(), -1029431783);
		Nose::assertEquals((new UUID("087d0b81-55fa-49ec-bf0d-281a79163951"))->hashCode(), -1684253914);
		Nose::assertEquals((new UUID("c3f57f4f-9517-4336-99b3-4cf99a1fb0c7"))->hashCode(), 1431224391);
		Nose::assertEquals((new UUID("00dbf098-072e-43bb-9cea-6c2f5a5a7ffd"))->hashCode(), -1052401423);
		Nose::assertEquals((new UUID("c064a2a0-59a4-4536-992e-3d4b8f686a3f"))->hashCode(), -1886998302);
		Nose::assertEquals((new UUID("3160cb66-9200-4d09-9b2b-a5c92dda0565"))->hashCode(), 361834179);
		Nose::assertEquals((new UUID("12e73d5c-11f1-49a1-8889-c28c061157fe"))->hashCode(), -1920015985);
	}
}
