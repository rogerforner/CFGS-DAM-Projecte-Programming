<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Professional Module to PDF</title>
    <style>
        .page-break {
            page-break-after: always;
        }
        .time {
            text-align: right;
        }
    </style>
</head>
<body>
    <!-- TRAINING UNITS -->
    <div id="section0">
        <h1>Institute X</h1>
        <hr>
        <p class="time"><em>{{ $data->updated_at }}</em></p>

        <ul style="list-style-type: none;">
            <li><strong>Name</strong>: UF{{ $data->uf }}, {{ $data->name }}</li>
            <li><strong>Responsible</strong>: {{ $data->updated_by }}</li>
            <li><strong>Teacher</strong>: {{ $data->created_by }}</li>
        </ul>
    </div>

    @if (count($data->temaries) > 0)
        <div class="page-break"></div>

        <!-- TRAINING UNITS -->
        <div id="section0">
            <h2>Temaries</h2>
            <hr>

            @foreach ($data->temaries as $temary)
                <h3>NF{{ $temary->nf }}, {{ $temary->name }}</h3>
                <ul style="list-style-type: none;">
                    <li><strong>Duration</strong>: {{ $temary->duration }}h</li>
                    <li><strong>Description</strong>: {{ $temary->description }}</li>
                </ul>
            @endforeach
        </div>
    @endif

    <div class="page-break"></div>

    <!-- SECTION 1 -->
    <div id="section1">
        <h2>Activities</h2>
        <hr>

        <p>{{ $data->section1 }}</p>
    </div>

    <div class="page-break"></div>

    <!-- SECTION 2 -->
    <div id="section2">
        <h2>Learning outcomes and evaluation criteria</h2>
        <hr>

        <p>{{ $data->section2 }}</p>
    </div>

    <div class="page-break"></div>

    <!-- SECTION 3 -->
    <div id="section3">
        <h2>Contents</h2>
        <hr>

        <p>{{ $data->section3 }}</p>
    </div>

    <div class="page-break"></div>

    <!-- SECTION 3 -->
    <div id="section4">
        <h2>Evaluation criteria</h2>
        <hr>

        <p>{{ $data->section4 }}</p>
    </div>
</body>
</html>