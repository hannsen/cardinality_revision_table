<?php

namespace Drupal\cardinality_revision_table\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;

/**
 * @ContentEntityType(
 *   id = "cardinality_rev",
 *   label = @Translation("CardinalityRevisionTableEntity"),
 *   admin_permission = "administer cardinality_revision_table",
 *   base_table = "cardinality_rev",
 *   revision_table = "cardinality_rev_revision",
 *   entity_keys = {
 *     "id" = "id",
 *     "revision" = "vid",
 *   }
 * )
 */
class CardinalityRevisionTableEntity extends ContentEntityBase {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel('name')
      ->setRevisionable(TRUE);

    // Does not get stored in revision database table vvv
    $fields['non_revisionable'] = BaseFieldDefinition::create('string')
      ->setLabel('non_revisionable')
      ->setRevisionable(FALSE);

    $fields['linked_users'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel('linked_users')
      ->setSetting('target_type', 'user')
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setRevisionable(FALSE);

    $fields['some_strings'] = BaseFieldDefinition::create('string')
      ->setLabel('some_strings')
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setRevisionable(FALSE);

    return $fields;
  }

}
