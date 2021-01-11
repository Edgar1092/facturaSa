<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
</head>
<body>
        <table>
                <tr>
                    <td></td>
                    <td>
                        <img src="{{ public_path('images/logo.png') }}" width="240" />
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td></td>
                    <td>
                        <br>
                        <b>Reporte de efectividad</b>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Desde: {{$since->format('d-m-Y')}} Hasta: {{$until->format('d-m-Y')}}</td>

                </tr>
                <tr>
                    <td></td>
                    <td>Cliente: {{$data->name}}</td>
                </tr>
            </table>

            <table class="table">
                    <tr>
                        <th>Fecha de cotización</th>
                        <th>Destino</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Estatus</th>
                        <th>Importe</th>
                    </tr>
                    @php

                        $import = 0;
                    @endphp
                    @foreach ($data->quotations as $i => $quotation)
                    @php
                        $import += $quotation->total;
                    @endphp
                        <tr>
                            <td>{{ $quotation->created_at->format('d-m-Y')}}</td>
                            <td>{{$quotation->destination}}</td>
                            <td>{{($quotation->start_date) ? $quotation->start_date->format('d-m-Y') : ''}}</td>
                            <td>{{($quotation->end_date) ? $quotation->end_date->format('d-m-Y') : ''}}</td>
                            <td>{{$quotation->status->name}}</td>
                            <td class="text-right">{{number_format($quotation->total,2,',','.')}}</td>

                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="5">
                            Totales
                        </th>
                        <th class="text-right">
                            {{number_format($import,2,',','.')}}
                        </th>

                    </tr>
                </table>
    <br>
    {{date('d-m-Y h:i A')}}
</body>
</html>
<?php
