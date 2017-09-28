<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForLogManager extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'system.logs', 'description' => 'Logs permissions group',
    ];

    protected $permissions = [
        ['name' => 'system.logs.index', 'description' => 'Logs index', 'type' => 0, 'default' => false],
        ['name' => 'system.logs.show', 'description' => 'Show log', 'type' => 0, 'default' => false],
        ['name' => 'system.logs.download', 'description' => 'Download log', 'type' => 0, 'default' => false],
        ['name' => 'system.logs.destroy', 'description' => 'Delete log', 'type' => 1, 'default' => false],
    ];

    protected $menu = [
        'name' => 'Logs', 'icon' => 'fa fa-fw fa-terminal', 'link' => 'system.logs.index', 'has_children' => false,
    ];

    protected $parentMenu = 'System';
}
