<?php

namespace App\Controllers;

use App\Exceptions\ValidatorException;
use App\Services\Validator;
use GuzzleHttp\Client;
use Spatie\PdfToText\Pdf;

/**
 * Class HomeController.
 */
class DocumentReviewController extends Controller
{
    /**
     * @var \GuzzleHttp\Client
     */
    private Client $http;

    /**
     * DocumentReviewController constructor.
     */
    public function __construct()
    {
        $this->http = new Client();
    }

    /**
     * Show index page.
     *
     * @return \App\Services\View
     */
    public function showForm()
    {
        return view('pages.index');
    }

    /**
     * Handle text processing.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return false|string
     */
    public function processText()
    {
        // Validate request.
        try {
            $this->validateRequest();
        } catch (ValidatorException $e) {
            return json_response([
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ]);
        }

        // Return response.
        return json_response([
            'data' => $this->analyseData($_REQUEST['text'])
        ]);
    }

    /**
     * Handle pdf processing, extract text from PDF.
     *
     * @throws \Spatie\PdfToText\Exceptions\PdfNotFound
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return false|string
     */
    public function processPDF()
    {
        // Validate request.
        try {
            $this->validateRequest();
        } catch (ValidatorException $e) {
            return json_response([
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ]);
        }

        // Extract text.
        $text = (new Pdf())
            ->setPdf($_FILES['pdf']['tmp_name'])
            ->text();

        // Return response.
        return json_response([
            'data' => $this->analyseData($text)
        ]);
    }

    /**
     * Handle validation of requests.
     *
     * @throws \App\Exceptions\ValidatorException
     * @return void
     */
    private function validateRequest(): void
    {
        if (isset($_REQUEST['text'])) {
            Validator::make($_REQUEST, [
                'text' => 'required|min:2',
                'label' => 'required|in:case,law',
            ])->validate();

            return;
        }

        if (isset($_FILES['pdf'])) {
            Validator::make($_REQUEST, [
                'pdf' => 'required|pdf',
                'label' => 'required|in:case,law',
            ])->validate();

            return;
        }

        throw new ValidatorException([
            'page' => 'Either text/pdf field is needed.'
        ]);
    }

    /**
     * Send the text to the AI-Powered API.
     *
     * @param string $text
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return array
     */
    private function analyseData(string $text): array
    {
        // TODO: remove
        return [
            'file' => $text
        ];

        $response = $this->http->post("", [
            'text' => $text
        ]);

        return (array) json_decode($response->getBody()->getContents());
    }
}