<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Scrapers\CheckLotteryTicketScraper;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckLotteryTicketController extends Controller
{
    private CheckLotteryTicketScraper $lotteryScraper;

    public function __construct(CheckLotteryTicketScraper $lotteryScraper)
    {
        $this->lotteryScraper = $lotteryScraper;
    }

    public function checkTicket(Request $request): View
    {
        $result = $this->lotteryScraper->handle(
            $request->isMethod('post') ? $request->all() : []
        );

        if (!$result) {
            abort(404);
        }

        return view($result['template'], [
            'content' => $result['content']
        ])->withHeaders([
            'X-Robots-Tag' => 'noindex, nofollow',
            'Cache-Control' => 'public, max-age=300'
        ]);
    }

    public function checkTicketApi(Request $request)
    {
        $result = $this->lotteryScraper->handle($request->all());

        if (!$result) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json([
            'content' => $result['content']
        ]);
    }
}
