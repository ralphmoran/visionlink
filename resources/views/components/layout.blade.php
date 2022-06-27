

<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Visionlink - Code test' }}</title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    <script src="https://unpkg.com/vue@3"></script>

    <style>
        h2 {
            text-align: center;
            padding: 20px 0;
        }

        .table-bordered {
            border: 1px solid #ddd !important;
        }

        table caption {
            padding: .5em 0;
        }

        @media screen and (max-width: 767px) {
            table caption {
                display: none;
            }
        }

        .p {
            text-align: center;
            padding-top: 140px;
            font-size: 14px;
        }

        /* input:invalid {
            border: red solid 3px;
        } */
    </style>

</head>

<body translate="no" id="app">

    <h2>{{ $title ?? 'Visionlink - Code test' }}</h2>

    <div class="container">
        <div class="row"></div>
            <div class="col-xs-12">
                <div class="table-responsivev no-border border-0">

                {{ $slot }}

                </div><!--end of .table-responsive-->
            </div>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.min.js'></script>

</body>

</html>

