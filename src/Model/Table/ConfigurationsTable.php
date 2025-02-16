<?php
/**
 * CakeManager (http://cakemanager.org)
 * Copyright (c) http://cakemanager.org
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) http://cakemanager.org
 * @link          http://cakemanager.org CakeManager Project
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Settings\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;

/**
 * Configurations Model
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ConfigurationsTable extends Table
{
    /**
     * Initialize method
     *
     * @param  array  $config  The configuration for the Table.
     *
     * @return void
     */
    public function initialize(array $config): void
    {
        $this->setTable('settings_configurations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
    }

    /**
     * @param  string  $name
     *
     * @return \Cake\ORM\Query
     */
    public function findByName(string $name): Query
    {
        return $this->find()->where(['Configurations.name' => $name]);
    }
}
