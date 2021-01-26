<?php

declare(strict_types=1);

namespace App\Domains\Core\Response;

use Illuminate\Http\Response;

trait HttpResponseTrait
{
    /** @var int */
    private $statusCode = 200;

    /** @var string */
    private $message;

    /** @var string */
    private $error;

    private $pagination;

    /** @var array */
    private $meta;

    public function statusCode(int $code)
    {
        $this->statusCode = $code;

        return $this;
    }

    public function message(string $message)
    {
        $this->message = $message;

        return $this;
    }

    public function error(string $error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @param array|string|object|null $data
     * @param array                    $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function content($data, $headers = [])
    {
        $responseData = [];

        if ($data) {
            $responseData['data'] = $data;
        }

        if (!empty($this->meta)) {
            $responseData['meta'] = $this->meta;
        }

        if (!empty($this->pagination)) {
            $responseData['pagination'] = $this->pagination;
        }

        if ($this->message) {
            $responseData['message'] = $this->message;
        }

        if ($this->error) {
            $responseData['error'] = $this->error;
        }

        return response()->json($responseData, $this->statusCode, $headers);
    }

    public function ok($data = null)
    {
        return $this->statusCode(Response::HTTP_OK)->message('Operation carried out successfully')->content($data);
    }

    public function created($data)
    {
        if (!$this->message) {
            $this->message = 'Created successfully';
        }

        return $this->statusCode(Response::HTTP_CREATED)->content($data);
    }

    public function updated($data)
    {
        if (!$this->message) {
            $this->message = 'Updated successfully';
        }

        return $this->statusCode(Response::HTTP_CREATED)->content($data);
    }

    public function noContent()
    {
        return $this->statusCode(Response::HTTP_NO_CONTENT)->content(null);
    }

    public function notFound(string $message = 'Not Found')
    {
        return $this->statusCode(Response::HTTP_NOT_FOUND)->message($message)->content(null);
    }

    public function badRequest(string $message = 'Bad Request')
    {
        return $this->statusCode(Response::HTTP_BAD_REQUEST)->message($message)->content(null);
    }
}
