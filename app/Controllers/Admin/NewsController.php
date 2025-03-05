<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\TinTuc;

class NewsController extends BaseController
{
    protected $tintucModel;

    public function __construct()
    {
        $this->tintucModel = new TinTuc();
    }
    
    public function tin_tuc() {
        $this->render('admin.tin_tuc.list');
    }
}
