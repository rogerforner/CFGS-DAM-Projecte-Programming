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
            <li><strong>Name</strong>: MP{{ $data->mp }}, {{ $data->name }}</li>
            <li><strong>Responsible</strong>: {{ $data->updated_by }}</li>
            <li><strong>Teacher</strong>: {{ $data->created_by }}</li>
        </ul>
    </div>

    @if (count($data->trainingUnits) > 0)
        <div class="page-break"></div>

        <!-- TRAINING UNITS -->
        <div id="section0">
            <h2>Training Units</h2>
            <hr>

            @foreach ($data->trainingUnits as $tunit)
                @if ($tunit->approved == true)
                    <h3>UF{{ $tunit->uf }}, {{ $tunit->name }}</h3>
                    <ul style="list-style-type: none;">
                        <li><strong>Starts</strong>: {{ $tunit->date_start }}</li>
                        <li><strong>Ends</strong>: {{ $tunit->date_end }}</li>
                        @foreach ($tunit->temaries as $temary)
                            <h4>NF{{ $temary->nf }}, {{ $temary->name }}</h4>
                            <ul>
                                <li><strong>Duration</strong>: {{ $temary->duration }}h</li>
                                <li><strong>Description</strong>: {{ $temary->description }}</li>
                            </ul>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
    @endif

    <div class="page-break"></div>

    <!-- SECTION 1 -->
    <div id="section1">
        <h2>Methodological strategies</h2>
        <hr>

        <p>{{ $data->section1 }}</p>
    </div>

    <div class="page-break"></div>

    <!-- SECTION 2 -->
    <div id="section2">
        <h2>Evaluation criteria</h2>
        <hr>

        <p>{{ $data->section2 }}</p>
    </div>

    <div class="page-break"></div>

    <!-- SECTION 3 -->
    <div id="section3">
        <h2>Resources</h2>
        <hr>

        <p>{{ $data->section3 }}</p>
    </div>

    <div class="page-break"></div>

    <!-- SECTION 3 -->
    <div id="section4">
        <h2>Dual</h2>
        <hr>

        <p>{{ $data->section4 }}</p>
    </div>
</body>
</html>