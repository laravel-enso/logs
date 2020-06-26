<?php

use LaravelEnso\Migrator\Database\Migration;

class CreateStructureForLogs extends Migration
{
    protected array $permissions = [
        ['name' => 'system.logs.index', 'description' => 'Logs index', 'is_default' => false],
        ['name' => 'system.logs.show', 'description' => 'Show log', 'is_default' => false],
        ['name' => 'system.logs.download', 'description' => 'Download log', 'is_default' => false],
        ['name' => 'system.logs.destroy', 'description' => 'Delete log', 'is_default' => false],
    ];

    protected array $menu = [
        'name' => 'Logs', 'icon' => 'terminal', 'route' => 'system.logs.index', 'order_index' => 999, 'has_children' => false,
    ];

    protected ?string $parentMenu = 'System';
}
