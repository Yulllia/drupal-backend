<?php

namespace Drupal\glossary_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Entity\Term;
use Drupal\Core\Url; 

class AddTermForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'add_term_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Term Name'),
      '#required' => TRUE,
    ];

    $form['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#required' => TRUE,
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $vocId = 'glossary_terms';

    $name = $form_state->getValue('name');
    $description = $form_state->getValue('description');

    $term = Term::create([
      'vid' => $vocId,
      'name' => $name,
      'field_glossary_description' => [
        'value' => $description,
        'format' => 'basic_html',
      ],
    ]);

    $term->save();

    $this->messenger()->addStatus($this->t('The term %name has been added to the glossary.', ['%name' => $name]));
  }

}