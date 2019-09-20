<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChecklistController extends Controller
{

    public function postIndex(Request $request){

        $content = $request->input('content');

        $this->validate($request, [
            'content' => 'required',
        ]);

        $minimum_words = config('config.minimum_words');
        $number_of_words = str_word_count($content, 0);

        if($number_of_words < $minimum_words){
            return response()->json(['error' => true, 'msg' => 'The text doesn\'t meet the minimum '.$minimum_words.' words count requirement.'], 422);
        }

        $keywords_list = config('config.keywords_list');
        $keywords_used = 0;

        foreach($keywords_list as $keyword){
            if (strpos($content, $keyword) !== false) {
                $keywords_used++;
            }
        }

        $average_keywords_density = $keywords_used !== 0 ? $keywords_used / $number_of_words : 0;

        return response()->json([
            'error' => false,
            'content' => $content,
            'keywords_used' => $keywords_used,
            'average_keywords_density' => round($average_keywords_density, 2)
        ], 200);

    }

}