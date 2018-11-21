<?php


use Phinx\Migration\AbstractMigration;

class NavigatorsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('navigators');
        $table->addColumn('nId', 'string', ['limit' => 100])
            ->addColumn('type', 'string', ['limit' => 5])
            ->addColumn('alias', 'string', ['limit' => 50])
            ->addColumn('latitude', 'decimal', ['precision' => 10, 'scale' => 8])
            ->addColumn('longitude', 'decimal', ['precision' => 11, 'scale' => 8])
            ->addColumn('time', 'timestamp')
            ->addIndex(['nId'], [
                'unique' => true,
                'name' => 'idx_nId',
            ])
            ->create();

    }
}
