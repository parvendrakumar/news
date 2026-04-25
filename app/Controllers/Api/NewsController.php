<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\NewsModel;
use CodeIgniter\API\ResponseTrait;

class NewsController extends BaseController
{
    use ResponseTrait;

    protected $newsModel;

    public function __construct()
    {
        $this->newsModel = new NewsModel();
    }

    public function index()
    {
        $lang = $this->request->getVar('lang') ?: 'hi';
        $limit = $this->request->getVar('limit') ?: 10;
        
        $news = $this->newsModel->getLatestNews($lang, $limit);
        
        return $this->respond([
            'status' => 200,
            'data'   => $news
        ]);
    }

    public function show($id)
    {
        $lang = $this->request->getVar('lang') ?: 'hi';
        $news = $this->newsModel->select('news.*, news_translations.*')
                                ->join('news_translations', 'news_translations.news_id = news.id')
                                ->where('news.id', $id)
                                ->where('news_translations.language', $lang)
                                ->first();

        if (!$news) {
            return $this->failNotFound('News not found');
        }

        return $this->respond([
            'status' => 200,
            'data'   => $news
        ]);
    }
}
