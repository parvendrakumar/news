<?php

namespace App\Controllers;

class Media extends BaseController
{
    public function index()
    {
        $path = FCPATH . 'uploads/news';
        $allFiles = [];
        $search = $this->request->getGet('q');
        
        if (is_dir($path)) {
            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            foreach ($iterator as $file) {
                if ($file->isFile() && in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $name = $file->getFilename();
                    
                    // Server-side filtering
                    if (!empty($search) && stripos($name, $search) === false) {
                        continue;
                    }

                    $allFiles[] = [
                        'name' => $name,
                        'size' => $file->getSize(),
                        'date' => $file->getMTime(),
                        'url'  => str_replace(FCPATH, base_url(), $file->getPathname())
                    ];
                }
            }
        }

        // Sort by date descending
        usort($allFiles, function($a, $b) {
            return $b['date'] <=> $a['date'];
        });

        // Manual Pagination
        $perPage = 18;
        $totalItems = count($allFiles);
        $totalPages = ceil($totalItems / $perPage);
        $currentPage = max(1, min($totalPages, (int)($this->request->getGet('page') ?: 1)));
        $offset = ($currentPage - 1) * $perPage;
        
        $files = array_slice($allFiles, $offset, $perPage);

        $data = [
            'files'       => $files,
            'totalFiles'  => $totalItems,
            'totalSize'   => array_sum(array_column($allFiles, 'size')),
            'currentPage' => $currentPage,
            'totalPages'  => $totalPages,
            'search'      => $search,
            'title'       => "Media Library",
            'perPage'     => $perPage
        ];
        
        return view('admin/media/index', $data);
    }

    public function upload()
    {
        $files = $this->request->getFileMultiple('files');
        $success = 0;
        $error = 0;

        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getName();
                    if (file_exists(FCPATH . 'uploads/news/' . $newName)) {
                        $newName = time() . '_' . $newName;
                    }
                    $file->move(FCPATH . 'uploads/news', $newName);
                    $success++;
                } else {
                    $error++;
                }
            }
        }

        return redirect()->back()->with('success', "$success assets uploaded successfully.");
    }

    public function importCsv()
    {
        $file = $this->request->getFile('csv_file');
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Select a valid CSV file.');
        }

        $success = 0;
        $error = 0;
        if (($handle = fopen($file->getTempName(), 'r')) !== FALSE) {
            fgetcsv($handle); // skip header
            while (($row = fgetcsv($handle)) !== FALSE) {
                $url = $row[0];
                if (filter_var($url, FILTER_VALIDATE_URL)) {
                    try {
                        $imageData = @file_get_contents($url);
                        if ($imageData) {
                            $name = basename(parse_url($url, PHP_URL_PATH));
                            if (!$name) $name = 'imported_' . time() . '.jpg';
                            file_put_contents(FCPATH . 'uploads/news/' . $name, $imageData);
                            $success++;
                        } else {
                            $error++;
                        }
                    } catch (\Exception $e) { $error++; }
                }
            }
            fclose($handle);
        }
        return redirect()->back()->with('success', "$success assets imported from URLs. $error failed.");
    }

    public function downloadFormat()
    {
        $filename = 'media_import_format.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        $output = fopen('php://output', 'w');
        fputcsv($output, ['image_url']);
        fputcsv($output, ['https://example.com/image1.jpg']);
        fputcsv($output, ['https://example.com/image2.png']);
        fclose($output);
        exit;
    }
}
