<?php

namespace Danilowa\LaravelQuotesMaster;

use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;


class Quotes
{
    private static $SUCCESS_MESSAGE = 'Operation completed successfully.';
    private static $ERROR_MESSAGE = 'An error occurred while processing the request.';

    public static function importQuotes()
    {
        $client = new Client([
            'verify' => false
        ]);

        $page = 1;

        do {
            $response = $client->get("https://api.quotable.io/quotes?page={$page}");
            $data = json_decode($response->getBody(), true);

            foreach ($data['results'] as $result) {
                DB::table('quotes')->insert([
                    'author' => $result['author'],
                    "author_slug" => $result['authorSlug'],
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
        $quotes = DB::table('quotes')->paginate($perPage);

        if ($quotes->total() > 0) {
            return self::responseQuotes($quotes, 'success', self::$SUCCESS_MESSAGE, 200);
        } else {
            return self::responseQuotes(null, 'error', self::$ERROR_MESSAGE, 404);
        }
    }

    public static function getRandomQuote()
    {
        $quote = DB::table('quotes')->inRandomOrder()->first();

        if ($quote) {
            return self::responseQuotes($quote, 'success', self::$SUCCESS_MESSAGE, 200);
        } else {
            return self::responseQuotes(null, 'error', self::$ERROR_MESSAGE, 404);
        }
    }

    public static function getRandomQuoteByAuthor(string $author)
    {
        $quote = DB::table('quotes')->where('author', $author)->inRandomOrder()->first();

        if ($quote) {
            return self::responseQuotes($quote, 'success', self::$SUCCESS_MESSAGE, 200);
        } else {
            return self::responseQuotes(null, 'error', self::$ERROR_MESSAGE, 404);
        }
    }

    public static function getRandomQuoteByLength(int $Length)
    {
        $quote = DB::table('quotes')->whereBetween('length', [$Length - 10, $Length + 10])->inRandomOrder()->first();

        if ($quote) {
            return self::responseQuotes($quote, 'success', self::$SUCCESS_MESSAGE, 200);
        } else {
            return self::responseQuotes(null, 'error', self::$ERROR_MESSAGE, 404);
        }
    }

    public static function getRandomQuoteByKeyword(string $keyword)
    {
        $quote = DB::table('quotes')->where('quote', 'like', "%{$keyword}%")->inRandomOrder()->first();

        if ($quote) {
            return self::responseQuotes($quote, 'success', self::$SUCCESS_MESSAGE, 200);
        } else {
            return self::responseQuotes(null, 'error', self::$ERROR_MESSAGE, 404);
        }
    }

    private static function responseQuotes($data, $status, $message, $statusCode)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'content' => $data
        ];

        return json_encode($response, $statusCode);
    }
};
