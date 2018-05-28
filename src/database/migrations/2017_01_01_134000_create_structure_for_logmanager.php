<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForLogManager extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'system.logs', 'description' => 'Logs permissions group',
    ];

    protected $permissions = [
        ['name' => 'system.logs.index', 'description' => 'Logs index', 'type' => 0, 'is_default' => false],
        ['name' => 'system.logs.show', 'description' => 'Show log', 'type' => 0, 'is_default' => false],
        ['name' => 'system.logs.download', 'description' => 'Download log', 'type' => 0, 'is_default' => false],
        ['name' => 'system.logs.destroy', 'description' => 'Delete log', 'type' => 1, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Logs', 'icon' => 'terminal', 'link' => 'system.logs.index', 'order_index' => 999, 'has_children' => false,
    ];

    protected $parentMenu = 'System';
}
