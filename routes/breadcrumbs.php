<?php
if (App::runningInConsole()) {
    return false;
}
$breadcrumbs = array(
    [
        'type' => 'index',
        'name' => 'dashboard.main',
        'screen' => 'dashboard',
        'params' => buildDashBoardParamsDefault(),
        'allow_link' => true,
        'childs' => [
            [
                'type' => 'resource',
                'screen' => 'admin',
                'reject' => ['index'],
            ],
            [
                'type' => 'index',
                'screen' => 'admin',
            ],
            [
                'type' => 'resource',
                'screen' => 'customer',
            ],
            [
                'type' => 'resource',
                'screen' => 'serial_numbers',
            ],
        ]
    ]
);
breadcrumb_register($breadcrumbs);
