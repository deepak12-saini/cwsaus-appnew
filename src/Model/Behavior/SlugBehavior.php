<?php

declare(strict_types=1);

namespace App\Model\Behavior;

use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\Utility\Text;

class SlugBehavior extends Behavior
{
    protected $_defaultConfig = [
        'field' => 'title',
        'slugField' => 'slug',
        'separator' => '-',
        'overwrite' => true,
        'length' => 256,
        'lower' => true,
    ];

    public function beforeSave(EventInterface $event, $entity, $options): void
    {
        $field = $this->getConfig('field');
        $slugField = $this->getConfig('slugField');
        $overwrite = $this->getConfig('overwrite');
        $length = (int)$this->getConfig('length');
        $lower = $this->getConfig('lower');
        $separator = $this->getConfig('separator');

        $value = $entity->get($field);
        if ($value === null || $value === '') {
            return;
        }

        if (!$overwrite && $entity->get($slugField)) {
            return;
        }

        $slug = Text::slug($value, ['replacement' => $separator, 'lower' => $lower]);
        if (strlen($slug) > $length) {
            $slug = substr($slug, 0, $length);
        }
        $entity->set($slugField, $slug);
    }
}
