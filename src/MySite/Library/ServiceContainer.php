<?php namespace App\MySite\Library;

use Exception;

class ServiceContainer {

  /** @var ServiceContainer */
  protected static ServiceContainer $instance;

  /**
   * @var array
   */
  protected array $container;

  public static function getContainer(): ServiceContainer
  {
    if (!isset(self::$instance)) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  /**
   * @param string $key
   * @return bool
   */
  public function hasService( string $key ): bool
  {
    return isset( $this->container[$key] );
  }

  /**
   * @param string $key
   * @return Object
   * @throws Exception
   */
  public function getService(string $key ): object
  {

    if( !$this->hasService($key)) {
      throw new Exception("no service with key: $key");
    }

    return $this->container[$key];
  }

  /**
   * @param string $key
   * @param object $service
   * @return ServiceContainer
   */
  public function setService(string $key, object $service ): self
  {
    $this->container[$key] = $service;
    return $this;
  }

}
