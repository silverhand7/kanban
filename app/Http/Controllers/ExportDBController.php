<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportDBController extends Controller
{
    public function export() {
        return \Spatie\DbDumper\Databases\PostgreSql::create()
        ->setDbName(env('DB_DATABASE'))
        ->setUserName(env('DB_USERNAME'))
        ->setPassword(env('DB_PASSWORD'))
        ->setHost(env('DB_HOST'))
        ->dumpToFile('dump.sql');
    }
}
