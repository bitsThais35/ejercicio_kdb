<?php


use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
/**
 * Class ResultadoDefaultWidget
 * @FieldWidget(
 *   id = "resultado_widget",
 *   label = @Translation("Resultado"),
 *   field_types = {
 *   "resultado_widget"
 *   }
 * )
 */
class ResultadoDefaultWidget extends WidgetBase
{

  /**
   * Returns the form for a single field widget.
   *
   * Field widget form elements should be based on the passed-in $element, which
   * contains the base form element properties derived from the field
   * configuration.
   *
   * The BaseWidget methods will set the weight, field name and delta values for
   * each form element. If there are multiple values for this field, the
   * formElement() method will be called as many times as needed.
   *
   * Other modules may alter the form element provided by this function using
   * hook_field_widget_single_element_form_alter() or
   * hook_field_widget_single_element_WIDGET_TYPE_form_alter().
   *
   * The FAPI element callbacks (such as #process, #element_validate,
   * #value_callback, etc.) used by the widget do not have access to the
   * original $field_definition passed to the widget's constructor. Therefore,
   * if any information is needed from that definition by those callbacks, the
   * widget implementing this method, or a
   * hook_field_widget[_WIDGET_TYPE]_form_alter() implementation, must extract
   * the needed properties from the field definition and set them as ad-hoc
   * $element['#custom'] properties, for later use by its element callbacks.
   *
   * @param \Drupal\Core\Field\FieldItemListInterface $items
   *   Array of default values for this field.
   * @param int $delta
   *   The order of this item in the array of sub-elements (0, 1, 2, etc.).
   * @param array $element
   *   A form element array containing basic properties for the widget:
   *   - #field_parents: The 'parents' space for the field in the form. Most
   *       widgets can simply overlook this property. This identifies the
   *       location where the field values are placed within
   *       $form_state->getValues(), and is used to access processing
   *       information for the field through the getWidgetState() and
   *       setWidgetState() methods.
   *   - #title: The sanitized element label for the field, ready for output.
   *   - #description: The sanitized element description for the field, ready
   *     for output.
   *   - #required: A Boolean indicating whether the element value is required;
   *     for required multiple value fields, only the first widget's values are
   *     required.
   *   - #delta: The order of this item in the array of sub-elements; see $delta
   *     above.
   * @param array $form
   *   The form structure where widgets are being attached to. This might be a
   *   full form structure, or a sub-element of a larger form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form elements for a single widget for this field.
   *
   * @see hook_field_widget_single_element_form_alter()
   * @see hook_field_widget_single_element_WIDGET_TYPE_form_alter()
   */
  public function formElement(
    FieldItemListInterface $items,
    $delta,
    array $element,
      array &$form,
        FormStateInterface $form_state
  ) {

    $element['resultado'] = array(
      '#type' => 'number',
      '#title' => t('Resultado'),
      '#default_value' => isset($items[$delta]->modifier) ? $items[$delta]->modifier : 0,
      '#size' => 3,
    );

    // If cardinality is 1, ensure a label is output for the field by wrapping
    // it in a details element.
    if ($this->fieldDefinition->getFieldStorageDefinition()->getCardinality() == 1) {
      $element += array(
        '#type' => 'fieldset',
        '#attributes' => array('class' => array('container-inline')),
      );
    }

    return $element;
  }
}
