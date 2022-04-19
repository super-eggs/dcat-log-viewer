<?php

namespace SuperEggs\Dcat\LogViewer;

use Dcat\Admin\Extend\Setting as Form;

class Setting extends Form
{
    public function title()
    {
        return "系统日志查看配置";
    }

    public function form()
    {
        $this->text('log_file_prefix', "日志文件前缀")
            ->required()
            ->default("laravel*")
            ->help("仅支持 laravel 自带日志文件解析,未自定义日志文件名,请不要修改!!!");
    }
}
