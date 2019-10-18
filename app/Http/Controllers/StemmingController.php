<?php

namespace App\Http\Controllers;

use App\Classes\PorterStemmerRussian;
use Illuminate\Http\Request;
use App\Classes\PorterStemmer;
use cijic\phpMorphy\Facade\Morphy;

class StemmingController extends Controller
{
    public function forEnglish(Request $request)
    {
        $words = explode(' ', $request->text);
        $result = [];
        foreach ($words as $word) {
            $result []= PorterStemmer::Stem($word);
        }
        $englishResult = implode(' ', $result);
        return redirect('/')->with(compact('englishResult'));
    }

    public function forRussian(Request $request)
    {
        $words = explode(' ', $request->text);
        $result = [];
        foreach ($words as $word) {
            $result []= PorterStemmerRussian::word($word);
        }
        $russianResult = implode(' ', $result);
        return redirect('/')->with(compact('russianResult'));
    }

    public function getLexem(Request $request)
    {
        $word = explode(' ', $request->text)[0];

        $result = [];

        $paradigms = Morphy::findWord(mb_strtoupper($word));

        $mapGrammemsNames = config('morphy-mapper');

        foreach ($paradigms as $paradigm) {
            $result []= '-----------------' . $paradigm->getBaseForm() . '------------------';
            foreach ($paradigm->getFoundWordForm() as $form) {
                $grammemsString = '';
                foreach ($form->getGrammems() as $grammem) {
                    $grammemsString .= array_key_exists($grammem, $mapGrammemsNames) ? $mapGrammemsNames[$grammem] . ', ' : $grammem . ', ';
                }
                $newLine = $form->getWord() . ' - ' . $mapGrammemsNames[$form->getPartOfSpeech()] . ', ' .  $grammemsString;
                if (!in_array($newLine, $result)) {
                    $result []= $newLine;
                }
            }
        }

        $russianLemmaResult = implode('<br>', $result);
        return redirect('/')->with(compact('russianLemmaResult'));
    }
}
