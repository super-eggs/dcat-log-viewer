<?php

namespace SuperEggs\Dcat\LogViewer;

use Dcat\Admin\Extend\ServiceProvider;

class LogViewerServiceProvider extends ServiceProvider
{
    protected $js = [
        'js/index.js',
    ];
    protected $css = [
        'css/index.css',
    ];

    public function register()
    {
        //
    }

    public function settingForm()
    {
        return new Setting($this);
    }

    // 定义菜单
    protected $menu = [
        [
            'title' => '系统日志',
            'uri' => 'logs-view',
            'icon' => 'fa-newspaper-o', // 图标可以留空
            'permission_id' => 'logs-view', // 绑定权限
            'roles' => [['slug' => 'logs-view']], // 绑定角色
        ],
    ];
}
