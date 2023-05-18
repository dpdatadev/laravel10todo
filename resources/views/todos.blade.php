<!--TODO-->
<?php
//$_POST request processing

use App\Models\Todo;

$displayVar = "nothing";


//Allowed input
$allowedTags = '<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
$allowedTags .= '<li><ol><ul><span><div><br><ins><del>';


if (isset($_POST['tinyContent']) && $_POST['tinyContent'] != '') {
    $displayVar = "it worked!" . $_POST['tinyContent'];
    $sTitle = strip_tags(stripslashes($_POST['title']), $allowedTags);
    $sContent = strip_tags(stripslashes($_POST['tinyContent']), $allowedTags) . "\n";

    Todo::create(
        ['title' => $sTitle, 'body' => $sContent]
    );
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/hahp7c2g5bvxi9592n0tg3nut01jw5ywe7pdkonv19qpfnp0/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>

</head>

<body>
    <?php echo $displayVar; ?>
    <?php echo "<br />"; ?>
    <?php echo "<hr />"; ?>
    <a href='login.php'>Login </a><small>|</small>
    <a href='logout.php'>Logout </a><small>|</small>
    <a href='/dbinfo'>Database Info </a>
    <div>
        <form method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>">
            @csrf
            <br />
            <label>New ToDO Title:</label>
            <br />
            <textarea id="title" name="title"></textarea>
            <br />
            <label>New ToDo/Goal Description:</label>
            <textarea id="tinyContent" name="tinyContent"></textarea>
            <br />
            <input type="submit" name="save" value="Submit" />
            <!--<input type="reset" name="reset" value="Reset" />-->
        </form>
    </div>
    <script>
        $('textarea#tinyContent').tinymce({
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
    <p>{{ session()->get('success') ?: '' }}</p>
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


<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TODOS</title>
    </head>
    <body class="antialiased">
        <p>{{ session()->get('success') ?: '' }}</p>
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
</html> -->
