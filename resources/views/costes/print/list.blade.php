<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <style type="text/css">
        /* Default style definitions */

        @page {
            margin: 0.25in;
        }

        /* General
        -----------------------------------------------------------------------*/
        body {
            background-color: transparent;
            color: black;
            font-family: "verdana", "sans-serif";
            margin: 0px;
            padding-top: 0px;
            font-size: 1em;
        }

        @media print {
            p {
                margin: 2px;
            }
        }

        h1 {
            font-size: 1.1em;
            font-style: italic;
        }

        h2 {
            font-size: 1.05em;
        }

        img {
            border: none;
        }

        pre {
            font-family: "verdana", "sans-serif";
            font-size: 0.7em;
        }

        ul {
            list-style-type: circle;
            list-style-position: inside;
            margin: 0px;
            padding: 3px;
        }

        li.alpha {
            list-style-type: lower-alpha;
            margin-left: 15px;
        }

        p {
            font-size: 0.8em;
        }

        a:link,
        a:visited {
            /* font-weight: bold;  */
            text-decoration: none;
            color: black;
        }

        a:hover {
            text-decoration: underline;
        }

        #body {
            padding-bottom: 2em;
            padding-top: 5px;
        }

        #body pre {
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        #money {
            text-align: right;
            padding-right: 20px;
        }

        /* Footer
        -----------------------------------------------------------------------*/
        #footer {
            color: black;
        }

        #copyright {
            padding: 5px;
            font-size: 0.6em;
            background-color: white;
        }

        #footer_spacer_row {
            width: 100%;
        }

        #footer_spacer_row td {
            padding: 0px;
            border-bottom: 1px solid #000033;
            background-color: #F7CF07;
            height: 2px;
            font-size: 2px;
            line-height: 2px;
        }

        #logos {
            padding: 5px;
            float: right;
        }

        /* Section Header
        -----------------------------------------------------------------------*/
        #section_header {
            text-align: center;
        }

        #job_header {
            text-align: left;
            background-color: white;
            margin-left: 5px;
            padding: 5px;
            border: 1px dashed black;
        }

        #job_info {
            font-weight: bold;
        }

        .header_details td {
            font-size: 0.6em;
        }

        .header_label {
            padding-left: 20px;
        }

        .header_field {
            padding-left: 5px;
            font-weight: bold;
        }

        /* Content
        -----------------------------------------------------------------------*/
        #content {
            padding: 0.2em 1% 0.2em 1%;
            min-height: 15em;
        }

        .page_buttons {
            text-align: center;
            margin: 3px;
            font-size: 0.7em;
            white-space: nowrap;
            font-weight: bold;
            width: 74%;
        }

        .link_bar {
            font-size: 0.7em;
            text-align: center;
            margin: auto;
            /*  white-space: nowrap; */
        }

        .link_bar a {
            white-space: nowrap;
            font-weight: bold;
        }

        .page_menu li {
            margin: 5px;
            font-size: 0.8em;
        }

        /* Detail
        -----------------------------------------------------------------------*/
        .detail_table {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            padding: 3px;
            margin: 15px;
        }

        .detail_head td {
            background-color: #ddd;
            color: black;
            font-weight: bold;
            padding: 3px;
            font-size: 0.75em;
            text-align: center;
        }

        .detail_label {
            padding: 3px;
            font-size: 0.75em;
            width: 16%;
            border-top: 1px solid #fff;
            border-bottom: 1px solid #fff;
            background-color: #ddd;
        }

        .detail_field {
            width: 33%;
            font-size: 0.8em;
            color: ;
            text-align: center;
            padding: 3px;
        }

        .detail_sub_table {
            font-size: 1em;
        }

        .detail_spacer_row td {
            border-top: 1px solid white;
            border-bottom: 1px solid white;
            background-color: #999;
            font-size: 2px;
            line-height: 2px;
        }

        #narrow {
            width: 50%;
        }

        .operation {
            width: 1%;
        }

        .summary_spacer_row {
            font-size: 0.1em;
        }

        .bar {
            border-top: 1px solid black;
        }

        /* Forms
        -----------------------------------------------------------------------*/
        .form {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            margin-top: 10px;
        }

        .form td {
            padding: 3px;
        }

        .form th, .form_head td {
            background-color: #ddd;
            border-bottom: 1px solid black;
            color: black;
            padding: 3px;
            text-align: center;
            font-size: 0.65em;
            font-weight: bold;
        }

        .form_head a:link,
        .form_head a:visited {
            color: black;
        }

        .form_head a:hover {
        }

        .sub_form_head td {
            border: none;
            font-size: 0.9em;
            white-space: nowrap;
        }

        .form input {
            color: black;
            background-color: white;
            border: 1px solid black;
            padding: 1px 2px 1px 2px;
            text-decoration: none;
            font-size: 1em;
        }

        .form textarea {
            color: black;
            background-color: white;
            border: 1px solid black;
            font-size: 1em;
        }

        .form select {
            color: black;
            background-color: white;
            font-size: 1em;
        }

        .button, a.button {
            color: black;
            background-color: white;
            border: 1px solid black;
            font-weight: normal;
            white-space: nowrap;
            text-decoration: none;
        }

        a.button {
            display: inline-block;
            text-align: center;
            padding: 2px;
        }

        a.button:hover {
            text-decoration: none;
            color: black;
        }

        .form_field {
            color: black;
            background-color: white;
            font-size: 0.7em;
        }

        .form_label {
            color: black;
            background-color: #ddd;
            font-size: 0.7em;
            padding: 3px;
        }

        /*
        .form_foot {
          background-color: #E5D9C3;
          font-size: 0.6em;
        }
        */

        .form_foot td {
            background-color: #ddd;
            border-bottom: 1px solid black;
            color: black;
            padding: 3px;
            text-align: center;
            font-size: 0.65em;
            font-weight: bold;
        }

        .form_foot a:link,
        .form_foot a:visited {
            color: black;
        }

        .form_foot a:hover {
            color: black;
        }

        .no_border_input input {
            border: none;
        }

        .no_wrap {
            white-space: nowrap;
        }

        tr.row_form td {
            white-space: nowrap;
        }

        /* Wizards
        -----------------------------------------------------------------------*/
        .wizard {
            font-size: 0.8em;
            border-top: 1px solid black;
        }

        #no_border {
            border: none;
        }

        .wizard p {
            text-indent: 2%;
        }

        .wizard td {
            padding: 3px;
            /*  padding-left: 3px;
              padding-right: 3px;
              padding-bottom: 3px;*/
        }

        .wizard input {
            color: black;
            background-color: white;
            border: 1px solid black;
            padding: 1px 2px 1px 2px;
            text-decoration: none;
        }

        .wizard textarea {
            color: black;
            background-color: white;
            border: 1px solid black;
        }

        .wizard select {
            color: black;
            background-color: white;
            border: 1px solid black;
        }

        .wizard_head {
            color: black;
            font-weight: bold;
        }

        .wizard_buttons {
            border-top: 1px solid black;
            padding-top: 3px;
        }

        .wizard_buttons a {
            background-color: white;
            border: 1px solid black;
            padding: 2px 3px 2px 3px;
        }

        /* List
        -----------------------------------------------------------------------*/
        .list_table,
        .notif_list_table {
            color: black;
            padding-bottom: 4px;
            background-color: white;
        }

        .list_table td,
        .notif_list_table td {
            padding: 3px 5px 3px 5px;
        }

        .list_table input {
            color: black;
            background-color: white;
            border: 1px solid black;
            padding: 1px 2px 1px 2px;
            text-decoration: none;
        }

        .list_head,
        .notif_list_head {
            font-weight: bold;
            background-color: #ddd;
            font-size: 0.65em;
        }

        .list_head td,
        .notif_list_head td {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            color: black;
            text-align: center;
            white-space: nowrap;
        }

        .list_head a:link,
        .list_head a:visited,
        .notif_list_head a:link,
        .notif_list_head a:visited {
            color: black;
        }

        .list_head a:hover,
        .notif_list_head a:hover {
        }

        .list_foot {
            font-weight: bold;
            background-color: #ddd;
            font-size: 0.65em;
        }

        .list_foot td {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            color: black;
            text-align: right;
            white-space: nowrap;
        }

        .sub_list_head td {
            border: none;
            font-size: 0.7em;
        }

        .odd_row td {
            /*  background-color: #EDF2F7;
              border-top: 2px solid #FFFFff;*/
            background-color: transparent;
            border-bottom: 0.9px solid #ddd; /* 0.9 so table borders take precedence */
        }

        .even_row td {
            /*  background-color: #F8EEE4;
              border-top: 3px solid #FFFFff;*/
            background-color: #f6f6f6;
            border-bottom: 0.9px solid #ddd;
        }

        .spacer_row td {
            line-height: 2px;
            font-size: 2px;
        }

        .phone_table td {
            border: none;
            font-size: 0.8em;
        }

        div.notif_list_text {
            margin-bottom: 1px;
            font-size: 1.1em;
        }

        .notif_list_row td.notif_list_job {
            text-align: center;
            font-weight: bold;
            font-size: 0.65em;
        }

        .notif_list_row td.notif_list_dismiss table td {
            text-align: center;
            font-size: 1em;
            border: none;
            padding: 0px 2px 0px 2px;
        }

        .notif_list_row td {
            padding: 5px 5px 7px 5px;
            border-bottom: 1px dotted #ddd;
            background-color: white;
            font-size: 0.6em;
        }

        .notif_list_row:hover td {
            background-color: #ddd;
        }

        /* Page
        -----------------------------------------------------------------------*/
        .page {
            border: none;
            padding: 0in;
            margin-right: 0.1in;
            margin-left: 0.1in;
            /*margin: 0.33in 0.33in 0.4in 0.33in; */
            background-color: transparent;
        }

        .page table.header h1 {
            font-size: 12pt;
        }

        .page > h2,
        .page > p {
            margin-top: 2pt;
            margin-bottom: 2pt;
        }

        .page h2 {
            page-break-after: avoid;
        }

        .money_table {
            border-collapse: collapse;
            font-size: 6pt;
        }

        /* Tree
        -----------------------------------------------------------------------*/
        .tree_div {
            display: none;
            background-color: #ddd;
            border: 1px solid #333;
        }

        .tree_div .tree_step_bottom_border {
            border-bottom: 1px dashed #8B9DBE;
        }

        .tree_div .button, .tree_row_table .button,
        .tree_div .no_button {
            width: 110px;
            font-size: 0.7em;
            padding: 3px;
            text-align: center;
        }

        /*
        .tree_div .button a, .tree_row_table .button a {
          text-decoration: none;
          color: #114C8D;
        }
        */

        .tree_row_desc {
            font-weight: bold;
            font-size: 0.7em;
            text-indent: -10px;
        }

        .tree_row_info {
            font-size: 0.7em;
            width: 200px;
        }

        .tree_div_head a,
        .tree_row_desc a {
            color: #000033;
            text-decoration: none;
        }

        .tree_div_head {
            font-weight: bold;
            font-size: 0.7em;
        }

        /* Summaries
        -----------------------------------------------------------------------*/
        .summary {
            border: 1px solid black;
            background-color: white;
            padding: 1%;
            font-size: 0.8em;
        }

        .summary h1 {
            color: black;
            font-style: normal;
        }

        /* Sales-agreement specific
        -----------------------------------------------------------------------*/
        table.sa_signature_box {
            margin: 2em auto 2em auto;
        }

        table.sa_signature_box tr td {
            padding-top: 1.25em;
            vertical-align: top;
            white-space: nowrap;
        }

        .special_conditions {
            font-style: italic;
            margin-left: 2em;
            white-space: pre;
        }

        .sa_head * {
            font-size: 7pt;
        }

        /* Change order specific
        -----------------------------------------------------------------------*/
        table.change_order_items {
            font-size: 8pt;
            width: 100%;
            border-collapse: collapse;
            margin-top: 2em;
            margin-bottom: 2em;
        }

        table.change_order_items > tbody {
            border: 1px solid black;
        }

        table.change_order_items > tbody > tr > th {
            border-bottom: 1px solid black;
        }

        table.change_order_items > tbody > tr > td {
            border-right: 1px solid black;
            padding: 0.5em;
        }

        td.change_order_total_col {
            padding-right: 4pt;
            text-align: right;
        }

        td.change_order_unit_col {
            padding-left: 2pt;
            text-align: left;
        }

    </style>
    <title>Costes: Lista</title>
</head>

<body marginwidth="0" marginheight="0">

<div id="body">

    <div id="section_header">
    </div>

    <div id="content">

        <div class="page" style="font-size: 7pt">
            {{--<table style="width: 100%;" class="header">
                <tbody>
                <tr>
                    <td><h1 style="text-align: left">SCHEDULE A</h1></td>
                    <td><h1 style="text-align: right">Job: 132-003</h1></td>
                </tr>
                </tbody>
            </table>--}}

            {{--<table style="width: 100%; font-size: 8pt;">
                <tbody>
                <tr>
                    <td>Job: <strong>132-003</strong></td>
                    <td>Purchasers(s): <strong>Palmer</strong></td>
                </tr>

                <tr>
                    <td>Created: <strong>2004-08-13</strong></td>
                    <td>Last Change: <strong>2004-08-16 9:28 AM</strong></td>
                </tr>

                <tr>
                    <td>Address: <strong>667 Pine Lodge Dr.</strong></td>
                    <td>Legal: <strong>N/A</strong></td>
                </tr>
                </tbody>
            </table>
--}}
            {{--<table style="width: 100%; border-top: 1px solid black; border-bottom: 1px solid black; font-size: 8pt;">

                <tbody>
                <tr>
                    <td>Model: <strong>Franklin</strong></td>
                    <td>Elevation: <strong>B</strong></td>
                    <td>Size: <strong>1160 Cu. Ft.</strong></td>
                    <td>Style: <strong>Reciprocating</strong></td>
                </tr>

                </tbody>
            </table>--}}

            <table class="change_order_items">

                <tbody>
                {{--<tr>
                    <td colspan="6"><h2>Standard Items:</h2></td>
                </tr>--}}

                </tbody>
                <tbody>
                <tr style="font-size: 7pt;">
                    <th>Nro. Orden</th>
                    <th>Cliente</th>
                    <th>Compuesto</th>
                    <th>Cajas</th>
                    <th>Kilos</th>
                    <th>Precio Venta</th>
                    <th>Precio Materiales</th>
                    <th>Precio Recolección</th>
                    <th>Precio Manipulación</th>
                    <th>Comentario 1</th>
                    <th>Comentario 2</th>
                    <th>Transporte</th>
                    <th>Devoluciones</th>
                    <th>Facturado</th>
                    <th>Cobrado</th>
                    <th>Total Gastos</th>
                    <th>Beneficio</th>
                    <th>Porcentaje</th>
                </tr>

                @foreach($costes as $row)
                    @php
                        $kilos = $row->pedido->kilos
                    @endphp

                    <tr class="{{ ($loop->even) ? 'even' : 'odd' }}_row" style="font-size: 7pt;">
                        <td style="text-align: center; font-size: 6pt;">{{ $row->pedido->nro_orden }}</td>
                        <td style="font-size: 6pt;">{{ $row->pedido->cliente->razon_social }}</td>
                        <td style="font-size: 6pt; width: 75px;">{{ $row->pedido->variable->variable." - ".$row->pedido->variable->caja->formato." - ".$row->pedido->variable->caja->modelo }}</td>
                        <td style="text-align: right;">{{ round($row->pedido->cajas, 2) }}</td>
                        <td style="text-align: right;">{{ round($row->pedido->kilos, 2) }}</td>
                        <td style="text-align: right;">{{ (!is_null($row->pedido->pedido_comercial)) ? round($row->pedido->pedido_comercial->precio, 2) : 0 }} €</td>
                        <td style="text-align: right;">{{ round($row->precio_mp, 2)." €" }}</td>
                        <td style="text-align: right;">{{ round($row->recoleccion, 2)." €" }}</td>
                        <td style="text-align: right;">{{ round($row->manipulacion, 2)." €" }}</td>
                        <td style="text-align: right;">{{ round($row->comentario1, 2)." €" }}</td>
                        <td style="text-align: right;">{{ round($row->comentario2, 2)." €" }}</td>
                        <td style="text-align: right;">{{ round($row->transporte, 2)." €" }}</td>
                        <td style="text-align: right;">{{ round($row->devoluciones, 2)." €" }}</td>
                        <td style="text-align: center;">{{ ($row->facturado) ? "SI" : "NO"}}</td>
                        <td style="text-align: center;">{{ ($row->cobrado) ? "SI" : "NO"}}</td>
                        <td style="text-align: right;">
                            @php
                                $gasto = $row->precio_mp + $row->recoleccion + $row->manipulacion + $row->comentario1 + $row->comentario2 + $row->transporte + $row->devoluciones;
                                echo round($gasto, 2)." €";
                            @endphp
                        </td>
                        <td style="text-align: right;">
                            @php
                                $beneficio = ((!is_null($row->pedido->pedido_comercial)) ? $row->pedido->pedido_comercial->precio : 0) * $kilos;
                                echo round($beneficio, 2)." €";
                            @endphp
                        </td>
                        <td style="text-align: center;">
                            @php
                                if($beneficio > 0){
                                    if ($gasto > 0){
                                        echo ( round((($beneficio / $gasto ) - 1), 2))." %";
                                    }else{
                                        echo 100;
                                    }
                                }else{
                                    echo 0;
                                }
                            @endphp

                        </td>
                    </tr>
                @endforeach

                </tbody>


                {{--<tbody>
                <tr>
                    <td colspan="3" style="text-align: right;">(Tax is not included; it will be collected on closing.)
                    </td>
                    <td colspan="2" style="text-align: right;"><strong>GRAND TOTAL:</strong></td>
                    <td class="change_order_total_col"><strong>$7560.00</strong></td>
                </tr>
                </tbody>--}}
            </table>

            {{--<table class="sa_signature_box" style="border-top: 1px solid black; padding-top: 2em; margin-top: 2em;">

                <tbody>
                <tr>
                    <td>WITNESS:</td>
                    <td class="written_field" style="padding-left: 2.5in">&nbsp;</td>
                    <td style="padding-left: 1em">PURCHASER:</td>
                    <td class="written_field" style="padding-left: 2.5in; text-align: right;">X</td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-top: 0em">&nbsp;</td>
                    <td style="text-align: center; padding-top: 0em;">Mr. Leland Palmer</td>
                </tr>

                <tr>
                    <td colspan="4" style="white-space: normal">
                        This change order shall have no force or effect until approved and signed
                        by an authorizing signing officer of the supplier. Any change or special
                        request not noted on this document is not contractual.
                    </td>
                </tr>

                <tr>
                    <td colspan="2">ACCEPTED THIS
                        <span class="written_field" style="padding-left: 4em">&nbsp;</span>
                        DAY OF <span class="written_field" style="padding-left: 8em;">&nbsp;</span>,
                        20<span class="written_field" style="padding-left: 4em">&nbsp;</span>.
                    </td>

                    <td colspan="2" style="padding-left: 1em;">TWIN PEAKS SUPPLY LTD.<br><br>
                        PER:
                        <span class="written_field" style="padding-left: 2.5in">&nbsp;</span>
                    </td>
                </tr>
                </tbody>
            </table>--}}

        </div>

    </div>
</div>

</body>
</html>
