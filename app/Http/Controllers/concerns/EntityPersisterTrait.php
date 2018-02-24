<?php
namespace App\Http\Controllers\concerns;

trait EntityPersisterTrait
{
    public function buildRecordFromArray(array $fields, array $values) {
        $result = [];
        foreach($fields as $field) {
            if (array_key_exists($field, $values)) {
                $result[$field] = $values[$field];
            }
        }

        return $result;
    }
}