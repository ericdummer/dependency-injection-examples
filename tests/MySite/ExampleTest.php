<?php namespace App\MySite;

use App\MySite\Library\CsvReader;
use App\MySite\Library\Dictionary;
use App\MySite\Library\ServiceContainer;
use App\MySite\Library\WordProcessor;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{

  public static function setUpBeforeClass(): void {
    ServiceContainer::getContainer()->setService('CsvReader', new CsvReader());
  }

  public function testNonsensicalAllConstructor(): void
  {
    /** @var Dictionary|MockObject $dictionaryMock */
    $dictionaryMock = $this->createMock(Dictionary::class);
    $dictionaryMock->method('getRandomWord')
      ->will(
        $this->onConsecutiveCalls("one", "two", "three")
      );

    /** @var WordProcessor|MockObject $wordProcessorMock */
    $wordProcessorMock = $this->createMock(WordProcessor::class);

    $sut = new Example($dictionaryMock, $wordProcessorMock);
    $results = $sut->getNonsensicalSentence(3);
    $expected = "one two three";
    $this->assertEquals($expected, $results);

  }

  public function testScoreAllConstructors(): void {

    /** @var Dictionary|MockObject $dictionaryMock */
    $dictionaryMock = $this->createMock(Dictionary::class);
    $dictionaryMock->method('getRandomWord')
      ->will(
        $this->onConsecutiveCalls("one", "two", "three")
      );

    /** @var WordProcessor|MockObject $wordProcessorMock */
    $wordProcessorMock = $this->createMock(WordProcessor::class);
    $wordProcessorMock->method('getFrequencyOfWord')
      ->will(
        $this->onConsecutiveCalls(1, 2, 3)
      );

    $sut = new Example($dictionaryMock, $wordProcessorMock);
    $results = $sut->getSentenceScore("one two three");
    $expected = 6;
    $this->assertEquals($expected, $results);

  }
}
