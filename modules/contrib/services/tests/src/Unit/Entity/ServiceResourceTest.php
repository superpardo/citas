<?php

namespace Drupal\Tests\services\Unit\Entity;

use Drupal\services\Entity\ServiceResource;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\services\Entity\ServiceResource
 *
 * @group services
 */
class ServiceResourceTest extends UnitTestCase {

  public function testCanConstructDefaultResource() {
    /** @var \Drupal\services\Entity\ServiceResource $resource */
    $resource = new ServiceResource(
      [
        'service_plugin_id' => 'test:plugin:id',
        'service_endpoint_id' => 'test_endpoint_id',
        'formats' => ['json'],
        'authentication' => ['cookie'],
        'no_cache' => 0,
      ],
      'service_endpoint_resource'
    );

    $this->assertEquals('test_endpoint_id.test.plugin.id', $resource->id(), 'ID constructed successfully.');
    $this->assertEquals(['json'], $resource->getFormats(), 'Formats found.');
    $this->assertEquals(['cookie'], $resource->getAuthentication(), 'Authentication found.');
    $this->assertEquals(0, $resource->getNoCache(), 'Cache setting found.');
  }

  public function testCanConstructResourceNoCacheFalse() {
    /** @var \Drupal\services\Entity\ServiceResource $resource */
    $resource = new ServiceResource(
      [
        'service_plugin_id' => 'test:plugin:id',
        'service_endpoint_id' => 'test_endpoint_id',
        'formats' => [],
        'authentication' => [],
        'no_cache' => FALSE,
      ],
      'service_endpoint_resource'
    );

    $this->assertEquals(0, $resource->getNoCache(), 'Cache setting found.');
  }

  public function testCanConstructResourceNoCacheTrue() {
    /** @var \Drupal\services\Entity\ServiceResource $resource */
    $resource = new ServiceResource(
      [
        'service_plugin_id' => 'test:plugin:id',
        'service_endpoint_id' => 'test_endpoint_id',
        'formats' => [],
        'authentication' => [],
        'no_cache' => TRUE,
      ],
      'service_endpoint_resource'
    );

    $this->assertEquals(1, $resource->getNoCache(), 'Cache setting found.');
  }

  public function testCanConstructResourceNoCache1() {
    /** @var \Drupal\services\Entity\ServiceResource $resource */
    $resource = new ServiceResource(
      [
        'service_plugin_id' => 'test:plugin:id',
        'service_endpoint_id' => 'test_endpoint_id',
        'formats' => [],
        'authentication' => [],
        'no_cache' => 1,
      ],
      'service_endpoint_resource'
    );

    $this->assertEquals(1, $resource->getNoCache(), 'Cache setting found.');
  }

}
