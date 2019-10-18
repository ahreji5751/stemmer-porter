<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Stemmer porter</title>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <form action="/english-stemming" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="english-stemmer-text">Enter english text:</label>
                    <textarea id="english-stemmer-text" name="text" class="form-control" required></textarea>
                </div>
                <button class="btn btn-primary">Go!</button>
            </form>
        </div>
        <div class="col-6">
            @if (session()->get('englishResult'))
                <div class="form-group">
                    <label>Result:</label>
                    <div>{{ session()->get('englishResult') }}</div>
                </div>
            @endif
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-6">
            <form action="/russian-stemming" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="russian-stemmer-text">Enter russian text:</label>
                    <textarea id="russian-stemmer-text" name="text" class="form-control" required></textarea>
                </div>
                <button class="btn btn-primary">Go!</button>
            </form>
        </div>
        <div class="col-6">
            @if (session()->get('russianResult'))
                <div class="form-group">
                    <label>Result:</label>
                    <div>{{ session()->get('russianResult') }}</div>
                </div>
            @endif
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-6">
            <form action="/russian-lemmas" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="russian-lemmas-text">Enter russian word:</label>
                    <input id="russian-lemmas-text" name="text" class="form-control" required />
                </div>
                <button class="btn btn-primary">Go!</button>
            </form>
        </div>
        <div class="col-6">
            @if (session()->get('russianLemmaResult'))
                <div class="form-group">
                    <label>Result:</label>
                    <div>{!! session()->get('russianLemmaResult') !!}</div>
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>
