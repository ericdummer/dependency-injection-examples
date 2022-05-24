<?php
namespace App\MySite\Library;

class WordProcessor {

  /**
   * @param $data
   * @return array
   */
  public function indexData($data): array {
    return array_column($data, 'frequency', 'word');
  }

  /**
   * @param array $data
   * @return array
   */
  public function getFrequencyOfWord(string $word, array $data): int
  {
    $indexed = $this->indexData($data);
    return $indexed[$word] ?? 0;
  }

}
