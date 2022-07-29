<?php

namespace Modules\SeoSorcery\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Acl\Utils\AclSeederHelper;
use Modules\SeoSorcery\Enum\SeoSorceryPermission;

class SeoSorceryDatabaseSeeder extends Seeder
{
    use AclSeederHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->acl('seo-sorcery')
            ->onlyWebGuard()
            ->attachEnum(SeoSorceryPermission::class, SeoSorceryPermission::All->value)
            ->create(config('seo-sorcery.role_name'));
    }
}
