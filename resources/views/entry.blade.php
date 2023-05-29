<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TODO Journal') }}</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>


    <p style='color: green;'><b>{{ session()->get('success') ?: '' }}</b></p>
    <a href="">Write New</a>


            <h1>{{$entry->title}}</h1>
            <hr />
            <div class="container text-center">{{$entry->contentBody}}</div>
            <br />
            <small><strong>{{$entry->created_at}}</strong></small>
            <br />
            <td><a href="">Edit</a></td>
            <td><a href="">Show</a></td>


</div>
</html>
