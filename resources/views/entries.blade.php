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
    <!--JQuery TINYMCE stuff-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/hahp7c2g5bvxi9592n0tg3nut01jw5ywe7pdkonv19qpfnp0/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>
    <div class="container">
    <h4>What's on your mind today?</h4>
    <small>{{date('y/m/d')}}</small>
    <hr />
    <a href='login.php'>Login </a><small>|</small>
    <a href='logout.php'>Logout </a><small>|</small>
    <a href='/dbinfo'>Database Info </a>
    <div class="container">
        <form method="POST" action="{{route('todos.create')}}">
            @csrf
            <br />
            <label>New Journal Entry Title:</label>
            <br />
            <input id="title" name="title"></input>
            <br />
            <label>New Journal Entry:</label>
            <textarea id="body" name="body"></textarea>
            <br />
            <button type="submit" name="save" value="Submit"></button>
            <!--<input type="submit" name="save" value="Submit" />-->
            <!--<input type="reset" name="reset" value="Reset" />-->
        </form>
    </div>
    </div>

    <script>
        $('textarea#body').tinymce({
            height: 500,
            menubar: false,
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
        });
    </script>
    <hr />
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="container">
    <p style='color: green;'><b>{{ session()->get('success') ?: '' }}</b></p>
    <a href="">Write New</a>
    <table>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Create Time</th>
        </tr>
        @forelse ($entries as $entry)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $entry->title }}</td>
            <td>{{$entry->created_at}}</td>
            <td><a href="">Edit</a></td>
            <td><a href="">Show</a></td>
        </tr>
        @empty
        <p>No entries found!</p>
        @endforelse
    </table>
    </div>



