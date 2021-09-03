<!DOCTYPE html>
<html>

<head>

    <title></title>
    @include('layouts.partials.head')
    @toastr_css
    <style>
        table.products-table {
            border-collapse: separate;
            border-radius: 10px;
            border-spacing: 0;
            box-shadow: 0 0 25px #aaa;
            margin: 4rem 0;
            width: 100%;
        }

        th {
            background-color: #fff;
            font-weight: normal;
            border-bottom: 1px solid #d1d1d1;
        }

        th,
        td {
            line-height: 1.5;
            padding: 0.75em;
            text-align: center;
        }

        td {
            background-color: white;
        }

        td:first-child {
            font-weight: bold;
            text-align: left;
        }

        tbody tr:nth-child(odd) td {
            background-color: #f6f6f6;
        }

        thead th:first-child {
            border-top-left-radius: 10px;
            text-align: left;
        }

        thead th:last-child {
            border-top-right-radius: 10px;
        }

        tbody tr:last-child td:first-child {
            border-bottom-left-radius: 10px;
        }

        tbody tr:last-child td:last-child {
            border-bottom-right-radius: 10px;
        }

        /* Stack rows vertically on small screens */
        @media (max-width: 30rem) {

            /* Hide column labels */
            thead tr {
                position: absolute;
                top: -9999rem;
                left: -9999rem;
            }

            tbody tr td {
                border-radius: none;
                text-align: left;
            }

            tbody tr:first-child td:first-child {
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
            }

            tbody tr:last-child td:last-child {
                border-bottom-left-radius: 10px;
                border-bottom-right-radius: 10px;
            }

            /* Leave a space between table rows */
            tr+tr td:first-child {
                border-top: 1px solid #d1d1d1;
            }

            /* Get table cells to act like rows */
            tr,
            td {
                display: block;
            }

            td {
                border: none;
                /* Leave a space for data labels */
                padding-left: 50%;
            }

            /* Data labels */
            td:before {
                content: attr(data-label);
                display: inline-block;
                font-weight: bold;
                line-height: 1.5;
                margin-left: -100%;
                width: 100%;
            }
        }

    </style>
</head>

<body>

    <div class="row">
        <div class="col-12">
            @include('layouts.partials.flash')
        </div>
    </div>

    <div class="services-sec py-4 text-center">
        <div class="container">
            <h1 style="text-align: center">{{ $provider->name }}</h1>
            <h1>
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>No Of Locations</th>
                            <th>Longtitud</th>
                            <th>Latitude</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($locations as $location)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td data-label="Product">{{ $location->longtitud }}</td>
                                <td data-label="Unlimited Plan">{{ $location->latitude }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </h1>
        </div>
    </div>


    <!-- start services section -->


    <!-- end services section -->



    @include('layouts.partials.footer-scripts')

</body>
@jquery
@toastr_js
@toastr_render

</html>
