<?php namespace App\MySite\Library;

use \Exception;

class Dictionary {
  const DEFAULT_FILE = __DIR__ . '/../files/dictionary.txt';

  protected $filePath;
  protected $fileData = [];

  /**
   * @param string|null $filePath
   */
  public function __construct(string $filePath = null)
  {
    $this->filePath = !is_null($filePath) ?: self::DEFAULT_FILE;
  }

  /**
   * @return array
   * @throws Exception
   */
  public function getDictionary(): array
  {
    if (count($this->fileData) < 1) {
      if (is_readable($this->filePath)) {
        $csvReader = ServiceContainer::getContainer()->getService('CsvReader');
        $this->fileData = $csvReader->loadFile($this->filePath);
      } else {
        //log (file is not readable)
        throw new Exception("File is not readable: {$this->filePath}");
      }
    }
    return $this->fileData;
  }

  /**
   * @param string $filePath
   * @param CsvReader $csvReader
   * @return array
   * @throws Exception
   */
  public function getDictionaryFromFile(string $filePath, CsvReader $csvReader): array
  {
    if (is_readable($filePath)) {
      return $csvReader->loadFile($this->filePath);
    } else {
      //log (file is not readable)
      throw new Exception("File is not readable: {$this->filePath}");
    }
  }

  /**
   * @param int $frequencyThreshold
   * @return mixed
   * @throws Exception
   */
  public function getRandomWord(int $frequencyThreshold = 1000) {
    $dictionaryData = $this->getDictionary();
    var_dump(array_slice($dictionaryData, 0, 5));
    array_multisort (array_column($dictionaryData, 'frequency'), SORT_DESC, $dictionaryData);
    $filtered = array_slice($dictionaryData, 0, $frequencyThreshold);
    $rand = mt_rand(0,count($filtered) - 1);
    $word = $filtered[$rand];
    return $word["word"];
  }
}
