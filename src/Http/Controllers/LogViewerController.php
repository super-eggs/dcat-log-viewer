<?php

namespace SuperEggs\Dcat\LogViewer\Http\Controllers;

use Dcat\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use SuperEggs\Dcat\LogViewer\DcatLogView;

class LogViewerController extends Controller
{
    /**
     * @param  null  $file
     * @param  Request  $request
     * @param  Content  $content
     * @return Content
     * @throws \Exception
     * @author guozhiyuan
     */
    public function index($file = null, Request $request, Content $content)
    {
        if ($file === null) {
            $file = (new DcatLogView())->getLastModifiedLog();
        }

        $viewer = new DcatLogView($file);
        $offset = $request->get('offset');

        return $content
            ->header('系统日志')
            ->description($viewer->getFilePath())
            ->body(view('super-eggs.dcat-log-viewer::index', [
                'logs' => $viewer->fetch($offset),
                'logFiles' => $viewer->getLogFiles(),
                'fileName' => $viewer->file,
                'end' => $viewer->getFileSize(),
                'tailPath' => admin_url('log-viewer-tail', ['file' => $viewer->file]),
                'prevUrl' => $viewer->getPrevPageUrl(),
                'nextUrl' => $viewer->getNextPageUrl(),
                'filePath' => $viewer->getFilePath(),
                'size' => static::bytesToHuman($viewer->getFileSize()),
            ]));
    }

    public function tail($file, Request $request)
    {
        $offset = $request->get('offset');

        $viewer = new DcatLogView($file);

        list($pos, $logs) = $viewer->tail($offset);

        return compact('pos', 'logs');
    }

    protected static function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2).' '.$units[$i];
    }
}
