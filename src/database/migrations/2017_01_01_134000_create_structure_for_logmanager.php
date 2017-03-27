<?php

use LaravelEnso\Core\app\Classes\StructureManager\StructureMigration;

class CreateStructureForLogManager extends StructureMigration
{
    protected $permissionsGroup = [
        'name' => 'system.logs', 'description' => 'Logs Permissions Group',
    ];

    protected $permissions = [
        ['name' => 'system.logs.index', 'description' => 'Logs index', 'type' => 0],
        ['name' => 'system.logs.show', 'description' => 'Show Log', 'type' => 0],
        ['name' => 'system.logs.download', 'description' => 'Download Log', 'type' => 0],
        ['name' => 'system.logs.destroy', 'description' => 'Delete Log', 'type' => 1],
    ];

    protected $menu = [
        'name' => 'Logs', 'icon' => 'fa fa-fw fa-terminal', 'link' => 'system/logs', 'has_children' => 0,
    ];

    protected $parentMenu = 'System';
}
