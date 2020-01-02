<?php

use LaravelEnso\Migrator\App\Database\Migration;
use LaravelEnso\Permissions\App\Enums\Types;

class CreateStructureForLogs extends Migration
{
    protected $permissions = [
        ['name' => 'system.logs.index', 'description' => 'Logs index', 'type' => Types::Read, 'is_default' => false],
        ['name' => 'system.logs.show', 'description' => 'Show log', 'type' => Types::Read, 'is_default' => false],
        ['name' => 'system.logs.download', 'description' => 'Download log', 'type' => Types::Read, 'is_default' => false],
        ['name' => 'system.logs.destroy', 'description' => 'Delete log', 'type' => Types::Write, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Logs', 'icon' => 'terminal', 'route' => 'system.logs.index', 'order_index' => 999, 'has_children' => false,
    ];

    protected $parentMenu = 'System';
}
