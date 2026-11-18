<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Registros de la landing</title>
    <style>
        * {
            font-family: DejaVu Sans, sans-serif;
        }

        body {
            font-size: 9px;
            color: #1f2937;
            margin: 0;
            padding: 12px;
        }

        h1 {
            font-size: 15px;
            margin: 0 0 4px;
        }

        p.meta {
            margin: 0 0 10px;
            font-size: 9px;
            color: #6b7280;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background-color: #3c4a99;
            color: #ffffff;
            text-align: left;
            padding: 5px 4px;
            font-size: 8px;
            text-transform: uppercase;
        }

        tbody td {
            border-bottom: 1px solid #e5e7eb;
            padding: 4px;
            vertical-align: top;
            word-break: break-word;
        }

        tbody tr:nth-child(even) td {
            background-color: #f6f7fb;
        }

        .empty {
            text-align: center;
            padding: 14px;
            color: #9ca3af;
        }
    </style>
</head>

<body>
    <h1>Registros de la landing: {{ $landing->title ?? 'Curso gratis' }}</h1>
    <p class="meta">
        Total: {{ count($rows) }} registros
        @if (!empty($range))
            &middot; Rango de fechas: {{ $range }}
        @endif
        &middot; Generado el {{ now()->format('d/m/Y H:i') }}
    </p>

    <table>
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
                <tr>
                    @foreach (array_values($row) as $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td class="empty" colspan="{{ count($headers) }}">Todavía no hay registros desde esta landing.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
