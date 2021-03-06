<?php

namespace Drupal\ejercicio_kdb;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Ejemplo kdb entities.
 *
 * @ingroup ejercicio_kdb
 */
class EjemploKdbListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Ejemplo kdb ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\ejercicio_kdb\Entity\EjemploKdb $entity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.ejemplo_kdb.edit_form',
      ['ejemplo_kdb' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
