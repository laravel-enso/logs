<?php

use Illuminate\Database\Migrations\Migration;
use LaravelEnso\Core\App\Classes\StructureManager\StructureSupport;

class CreateStructureForLogManager extends Migration
{
    use StructureSupport;

    private $permissionsGroup = [
        'name' => 'system.logs', 'description' => 'Logs Permissions Group',
    ];

    private $permissions = [
        ['name' => 'system.logs.index', 'description' => 'Logs index', 'type' => 0],
        ['name' => 'system.logs.show', 'description' => 'Show Log', 'type' => 0],
        ['name' => 'system.logs.download', 'description' => 'Download Log', 'type' => 0],
        ['name' => 'system.logs.destroy', 'description' => 'Delete Log', 'type' => 1],
    ];

    private $menu = [
        'name' => 'Logs', 'icon' => 'fa fa-fw fa-terminal', 'link' => 'system/logs', 'has_children' => 0,
    ];

    private $parentMenu = 'System';
    private $roles;
}
