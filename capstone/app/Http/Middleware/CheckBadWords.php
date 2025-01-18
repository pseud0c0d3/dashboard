<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBadWords
{
    /**
     * List of prohibited words.
     *
     * @var array
     */
    protected $badWords = [
        'putang ina', 'bobo', 'tanga', // Add your list of bad words here
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Combine title and body to check for bad words
        $content = strtolower($request->input('title', '') . ' ' . $request->input('body', ''));

        foreach ($this->badWords as $badWord) {
            if (str_contains($content, strtolower($badWord))) {
                return back()->withErrors(['error' => 'Your post contains inappropriate language.']);
            }
        }

        return $next($request);
    }
}
