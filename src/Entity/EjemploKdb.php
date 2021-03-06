<?php

namespace Drupal\ejercicio_kdb\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Ejemplo kdb entity.
 *
 * @ingroup ejercicio_kdb
 *
 * @ContentEntityType(
 *   id = "ejemplo_kdb",
 *   label = @Translation("Ejemplo kdb"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ejercicio_kdb\EjemploKdbListBuilder",
 *     "views_data" = "Drupal\ejercicio_kdb\Entity\EjemploKdbViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\ejercicio_kdb\Form\EjemploKdbForm",
 *       "add" = "Drupal\ejercicio_kdb\Form\EjemploKdbForm",
 *       "edit" = "Drupal\ejercicio_kdb\Form\EjemploKdbForm",
 *       "delete" = "Drupal\ejercicio_kdb\Form\EjemploKdbDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\ejercicio_kdb\EjemploKdbHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\ejercicio_kdb\EjemploKdbAccessControlHandler",
 *   },
 *   base_table = "ejemplo_kdb",
 *   translatable = FALSE,
 *   admin_permission = "administer ejemplo kdb entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/ejemplo_kdb/{ejemplo_kdb}",
 *     "add-form" = "/admin/structure/ejemplo_kdb/add",
 *     "edit-form" = "/admin/structure/ejemplo_kdb/{ejemplo_kdb}/edit",
 *     "delete-form" = "/admin/structure/ejemplo_kdb/{ejemplo_kdb}/delete",
 *     "collection" = "/admin/structure/ejemplo_kdb",
 *   },
 *   field_ui_base_route = "ejemplo_kdb.settings"
 * )
 */
class EjemploKdb extends ContentEntityBase implements EjemploKdbInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getDato1() {
    return $this->get('dato_1')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getDato2() {
    return $this->get('dato_2')->value;
  }

  /**
   * {@inheritdoc}
   * @throws \Drupal\Core\Entity\Exception\UnsupportedEntityTypeDefinitionException
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('Name'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'integer',
        'weight' => -4,
      ]);
    $fields['dato_1'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Dato 1'))
      ->setDescription(t('Dato 1 para suma'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'integer',
        'weight' => -4,
      ])
      ->addConstraint('UniqueField')
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['dato_2'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Dato 2'))
      ->setDescription(t('Dato 2 para suma'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'integer',
        'weight' => -4,
      ])
      ->addConstraint('UniqueField')
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
