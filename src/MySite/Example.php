<?php namespace App\MySite;

use App\MySite\Library\Dictionary;
use App\MySite\Library\WordProcessor;
use Exception;
use SebastianBergmann\Diff\Output\AbstractChunkOutputBuilder;

class Example
{
  protected Dictionary $dictionary;
  protected WordProcessor $wordProcessor;

  public function __construct(Dictionary $dictionary, WordProcessor $wordProcessor)
  {
    $this->dictionary = $dictionary;
    $this->wordProcessor = $wordProcessor;
  }

  /*
  public function setDictionary(Dictionary $dictionary): Example
  {
    $this->dictionary = $dictionary ;
    return $this;
  }

  public function setWordProcessor(WordProcessor $wordProcessor): Example
  {
    $this->wordProcessor = $wordProcessor;
    return $this;
  }*/

  /**
   * Get a number of random words to make a nonsensical sentence
   * @param int $numWords
   * @return string
   */
  public function getNonsensicalSentence(int $numWords): string
  {
    $sentenceArray = [];
    for($i = 0; $i < $numWords; $i++) {
      try {
        $newWord = $this->dictionary->getRandomWord();
      } catch (Exception $e) {
        //fail silently
        return "";
      }
      $sentenceArray[] = $newWord;
    }
    return implode(" ", $sentenceArray);
  }

  /**
   * combing the frequency of each word in a sentence create a score
   * @param string $sentence
   * @return int
   */
  public function getSentenceScore(string $sentence): int {
    $words = explode(" ", $sentence);
    $score = 0;
    try {
      $dictionaryData = $this->dictionary->getDictionary();
    } catch (Exception $e) {
      //fail silently
      $dictionaryData = [];
    }
    foreach($words as $word) {
      $score += $this->wordProcessor->getFrequencyOfWord($word, $dictionaryData);
    }
    return $score;
  }
}
