<?php

namespace App\MySite\Library;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DictionaryTest extends TestCase
{

    public function testGetDictionary()
    {
      /** @var CsvReader|MockObject $csvReaderMock */
      $csvReaderMock = $this->createMock(CsvReader::class);
      $csvReaderMock->expects($this->once())->method('loadFile');
      ServiceContainer::getContainer()->setService('CsvReader', $csvReaderMock);

      $sut = new Dictionary();
      $sut->getDictionary();
    }

  public function testGetDictionaryFromFile()
  {
    /** @var CsvReader|MockObject $csvReaderMock */
    $csvReaderMock = $this->createMock(CsvReader::class);
    $csvReaderMock->expects($this->once())->method('loadFile');

    $sut = new Dictionary();
    $sut->getDictionaryFromFile(Dictionary::DEFAULT_FILE, $csvReaderMock);
  }
}
