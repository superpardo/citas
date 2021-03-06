<?php

namespace Drupal\services\Form;

use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class \Drupal\services\Form\ServiceEndpointForm.
 */
class ServiceEndpointForm extends EntityForm {

  /**
   * Plugin manager.
   *
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $manager;

  /**
   * Constructor for \Drupal\services\Form\ServiceEndpointForm.
   *
   * @param \Drupal\Component\Plugin\PluginManagerInterface $manager
   *   The service definition plugin manager.
   */
  public function __construct(PluginManagerInterface $manager) {
    $this->manager = $manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.services.service_definition')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    /** @var \Drupal\services\Entity\ServiceEndpoint $service_endpoint */
    $service_endpoint = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $service_endpoint->label(),
      '#description' => $this->t('Label for the service endpoint.'),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $service_endpoint->id(),
      '#machine_name' => [
        'exists' => '\Drupal\services\Entity\ServiceEndpoint::load',
      ],
      '#disabled' => !$service_endpoint->isNew(),
    ];

    $form['endpoint'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Endpoint'),
      '#maxlength' => 255,
      '#default_value' => $service_endpoint->getEndpoint(),
      '#description' => $this->t('URL endpoint.'),
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $service_endpoint = $this->entity;
    $status = $service_endpoint->save();

    if ($status) {
      $this->messenger()->addMessage($this->t('Saved the %label service endpoint.', [
        '%label' => $service_endpoint->label(),
      ]));
    }
    else {
      $this->messenger()->addMessage($this->t('The %label service endpoint was not saved.', [
        '%label' => $service_endpoint->label(),
      ]));
    }
    $form_state->setRedirectUrl($service_endpoint->toUrl('collection'));
  }

}
