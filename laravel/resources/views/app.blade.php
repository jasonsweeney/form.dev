<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forms</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link type="text/css" media="screen, print" href="/css/all.css" rel="stylesheet"/>
    <script src="/js/jquery.js"></script>
</head>
<body>
@include('partials.nav')
@include('alerts.database')

@yield('content')
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="/js/all.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    $(document).foundation();
</script>
@yield('scripts')
</body>
</html>