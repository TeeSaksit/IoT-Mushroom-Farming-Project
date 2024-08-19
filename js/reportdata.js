$(document).ready(function () {
    fetchYear();

    var table = $('#table2').DataTable({
        'fixedColumns': {
            start: 1,
            end: 1
        },
        'scrollCollapse': true,
        'scrollX': true,
        'order': [[0, 'desc']],
        'dom': 'Bflrtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'responsive': true,
        'ajax': { url: './db/data-report.php?func=fetch-tableDetail' },
        'columns': [
            { "data": "havest_date" },
            { "data": "mushroom_name" },
            { "data": "havest_product" },
            { "data": "planting_date" },
            { "data": "mushroom_amount" },
        ]
    });

    setInterval(() => {
        table.ajax.reload(null, false);
    }, 2000);


    $('#yearSelect').on('change', function () {
        var year_selectID = $(document).find("#yearSelect").val();
        var yearText = $( "#yearSelect option:selected" ).text();
        $('#graph-product').html("กราฟผลผลิต ปี "+yearText);
        $('#report-product').html("รายงานผลทั้งหมด ปี "+yearText);
        table.ajax.url('./db/data-report.php?func=fetch-tableDetail&year_id=' + year_selectID);
        table.ajax.reload();
    });

    function fetchYear() {
        $.ajax({
            url: './db/data-report.php',
            type: 'GET',
            data: { func: 'fetch-year'},
            dataType: 'json',
            success: function (data) {
                var srow = $('#yearSelect');
                srow.empty();
    
                $.each(data, function (index, row) {
                    var option = $('<option>').text(row.textYear).val(row.Year);
                    srow.append(option);
                });
            }
        });
    }

});