<?php

/**
 * @file
 * Contains \Drupal\\Form\Pagos\AgregarFactura.
 */

namespace Drupal\tuul_module\Form\Pagos;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormState;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Unicode;
use Drupal\Core\Url;
use Drupal\node\Entity\User;
Use Drupal\taxonomy\Entity\Term;
use Drupal\file\Entity\File;
use Drupal\node\Entity\Node;

class AgregarCitaForm extends FormBase{

  public function getFormID() {
    return 'agregar_cita_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state ){

  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

  }
}

?>
