<?php

namespace App\Http\Controllers;

use App\Classes\PorterStemmerRussian;
use Illuminate\Http\Request;
use App\Classes\PorterStemmer;

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
        $words = explode(' ', $request->text);
        $result = [];
        foreach ($words as $word) {
            $result []= $this->getLexemFromDB($word);
        }
        $russianLemmaResult = implode(' ', $result);
        return redirect('/')->with(compact('russianLemmaResult'));
    }

    private function getLexemFromDB($name)
    {
        $results = \DB::select(
            \DB::raw("SELECT sg_entry.name FROM sg_form, sg_entry WHERE sg_form.name=:name AND sg_entry.id=sg_form.id_entry"), [
                'name' => $name
            ]
        );
        return count($results) ? $results[0]->name : 'empty';
    }
}
