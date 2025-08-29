<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;

class WordReaderController extends Controller
{
    /**
     * Display a form for uploading a Word document.
     *
     * @return \Illuminate\View\View
     */
    public function showUploadForm()
    {
        //return view('word-reader.upload');
    }

    /**
     * Handle the file upload and read the Word document.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function readDocument()
    {
        // Validate the uploaded file to ensure it's a DOCX file
        // $request->validate([
        //     'document' => 'required|mimes:docx,doc|max:10240', // Max 10MB
        // ]);

        try {
            $filePath = public_path('assets/docs/hidro-projekt-doc.docx');
            $phpWord = IOFactory::load($filePath);

            // Convert to HTML
            $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
            ob_start();
            $htmlWriter->save('php://output');
            $htmlContent = ob_get_clean();

            //dd($htmlContent);

            return view('word-reader', ['content' => $htmlContent]);
        } catch (\Exception $e) {
            // In case of an error, redirect back with a message
            return back()->with('error', 'Error reading document: ' . $e->getMessage());
        }
    }
}
