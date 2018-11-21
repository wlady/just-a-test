<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            'name' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
        ];
        $users = $this->table('users');
        $users->insert($data)
            ->save();
    }
}
