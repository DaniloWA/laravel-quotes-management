<?php

namespace Danilowa\LaravelQuotesManagement;

use App\Models\Quotes as ModelQuotes;
use GuzzleHttp\Client;


class Quotes
{
    const SUCCESS_MESSAGE = 'Operation completed successfully.';
    const ERROR_MESSAGE = 'An error occurred while processing the request.';
    const URL_API_QUOTABLE = "https://api.quotable.io/quotes";

    public static function importQuotes()
    {
        $client = new Client([
            'verify' => false
        ]);

        $page = 1;

        do {
            $response = $client->get(self::URL_API_QUOTABLE . "?page={$page}");
            $data = json_decode($response->getBody(), true);

            foreach ($data['results'] as $result) {
                ModelQuotes::create([
                    'author' => $result['author'],
                    'quote' => $result['content'],
                    'length' => $result['length'],
                ]);
            }

            $page++;
        } while ($page <= $data['totalPages']);
    }

    public static function getQuotePaginate(int $perPage = 5)
    {
        $perPage = max(5, min($perPage, 20));
        $quotes = ModelQuotes::paginate($perPage);

        if ($quotes->total() > 0) {
            return self::response($quotes, 'success', self::SUCCESS_MESSAGE, 200);
        }

        return self::response(null, 'error', self::ERROR_MESSAGE, 404);
    }

    public static function getRandomQuote()
    {
        $quote = ModelQuotes::inRandomOrder()->first();

        if ($quote) {
            return self::response($quote, 'success', self::SUCCESS_MESSAGE, 200);
        }

        return self::response(null, 'error', self::ERROR_MESSAGE, 404);
    }

    public static function getRandomQuoteByAuthor(string $author)
    {
        $quote = ModelQuotes::where('author', $author)->inRandomOrder()->first();

        if ($quote) {
            return self::response($quote, 'success', self::SUCCESS_MESSAGE, 200);
        }

        return self::response(null, 'error', self::ERROR_MESSAGE, 404);
    }

    public static function getRandomQuoteByLength(int $Length)
    {
        $quote = ModelQuotes::whereBetween('length', [$Length - 10, $Length + 10])->inRandomOrder()->first();

        if ($quote) {
            return self::response($quote, 'success', self::SUCCESS_MESSAGE, 200);
        }

        return self::response(null, 'error', self::ERROR_MESSAGE, 404);
    }

    public static function getRandomQuoteByKeyword(string $keyword)
    {
        $quote = ModelQuotes::where('quote', 'like', "%{$keyword}%")->inRandomOrder()->first();

        if ($quote) {
            return self::response($quote, 'success', self::SUCCESS_MESSAGE, 200);
        }

        return self::response(null, 'error', self::ERROR_MESSAGE, 404);
    }

    private static function response($data, $status, $message, $statusCode)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'content' => $data
        ];

        return json_encode($response, $statusCode);
    }
};
