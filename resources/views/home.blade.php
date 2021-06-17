<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Affiliates Within 100KM of the Dublin Office</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
    </head>
    <body class="container">
        <h1 class="text-center">
            Affiliates Within 100KM of the Dublin Office
        </h1>

        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Affiliate ID</th>
            </tr>

            @foreach ($affiliates as $affiliate)
                <tr>
                    <th>
                        {{ $affiliate->name }}
                    </th>
                    <th>
                        {{ $affiliate->affiliate_id }}
                    </th>
                </tr>
            @endforeach
        </table>
    </body>
</html>
