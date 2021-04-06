@component('mail::message')
# Introduction

Hai creato un articolo.
"{{ $article->title }}"
Per visualizzarlo clicca sul bottone..

@component('mail::button', ['url' => 'http://blogadmin.test/' . $article->author->name . '/' . $article->slug])
Vai al tuo articolo
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
