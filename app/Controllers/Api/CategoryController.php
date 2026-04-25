<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use CodeIgniter\API\ResponseTrait;

class CategoryController extends BaseController
{
    use ResponseTrait;

    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $lang = $this->request->getVar('lang') ?: 'hi';
        $categories = $this->categoryModel->getCategories($lang);
        
        return $this->respond([
            'status' => 200,
            'data'   => $categories
        ]);
    }
}
