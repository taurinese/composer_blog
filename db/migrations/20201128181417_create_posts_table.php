<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePostsTable extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('articles');
        $table->addColumn('user_id', 'integer')
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime')
            ->addColumn('title', 'string')
            ->addColumn('body', 'text')
            ->create();
    }
}
