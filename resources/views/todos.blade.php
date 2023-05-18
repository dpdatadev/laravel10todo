<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/hahp7c2g5bvxi9592n0tg3nut01jw5ywe7pdkonv19qpfnp0/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>

</head>

<body>
    <h4>What's the goal for today?</h4>
    <small>{{date('y/m/d')}}</small>
    <hr />
    <a href='login.php'>Login </a><small>|</small>
    <a href='logout.php'>Logout </a><small>|</small>
    <a href='/dbinfo'>Database Info </a>
    <div>
        <form method="POST" action="{{route('todos.create')}}">
            @csrf
            <br />
            <label>New ToDO Title:</label>
            <br />
            <textarea id="title" name="title"></textarea>
            <br />
            <label>New ToDo/Goal Description:</label>
            <textarea id="body" name="body"></textarea>
            <br />
            <input type="submit" name="save" value="Submit" />
            <!--<input type="reset" name="reset" value="Reset" />-->
        </form>
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
    <p style='color: green;'><b>{{ session()->get('success') ?: '' }}</b></p>
    <a href="">Create New</a>
    <table>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Details</th>
            <th>Is Completed</th>
            <th>Create Time</th>
        </tr>
        @forelse ($todos as $todo)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $todo->title }}</td>
            <td>{{$todo->body}}</td>
            <td>{{$todo->is_completed}}</td>
            <td>{{$todo->created_at}}</td>
            <td><a href="">Edit</a></td>
            <td><a href="">Show</a></td>
            <form method="POST" action="">
                @csrf
                @method('delete')
                <button type="submit">Delete</button>
            </form>
        </tr>
        @empty
        <p>No todos found!</p>
        @endforelse
    </table>
</body>

</html>
