$(document).ready(function () {
    fetchRowdata();
    setInterval(fetchRowdata, 1000);
    var table = $('#table1').DataTable({
        'fixedColumns': {
            start: 1,
            end: 1
        },
        'scrollCollapse': true,
        'scrollX': true,
        'order': [[6, 'desc']],
        'dom': 'Bflrtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'responsive': true,
        'ajax': { url: './db/data-farm.php?func=fetch-tableDetail&row_id=' },
        'columns': [
            { "data": "row_number" },
            { "data": "plan_date" },
            { "data": "mushroom_name" },
            {
                "data": "havest_date", render: function (data, type, row, meta) {
                    return type === 'display' ?
                        '<td>' + (data == "00 / 00 / 0000" ? "--" : data) + '</td>' :
                        data;
                }
            },
            {
                "data": "mushroom_amount"
            },
            {
                "data": "havest_product", render: function (data, type, row, meta) {
                    return type === 'display' ?
                        '<td>' + (data == "0" ? "--" : data) + '</td>' :
                        data;
                }
            },
            {
                "data": "havest_status", render: function (data, type, row, meta) {
                    if (data == "0") {
                        return type === 'display' ?
                            '<span class="badge bg-success prevent-select">เก็บเกี่ยวแล้ว</span>' :
                            data;
                    } else {
                        return type === 'display' ?
                            '<a type="button" id="' + row.harvestID + '" class="change-status" data-id="' + row.rowID + '" data-name="' + row.row_number + '" data-m="' + row.mushroomID + '"><span class="badge bg-warning">กำลังเพาะปลูก</span></a>' :
                            data;
                    }
                }
            },
            {
                "data": "harvestID", render: function (data, type, row, meta) {
                    if (row.havest_status == "1") {
                        return type === 'display' ?
                            '<span class="badge"><img src="img/png/editExit.png" class="bt-table"></span>' :
                            data;
                    } else {
                        return type === 'display' ?
                            '<a type="button" id="' + data + '" class="edit-status"><span class="badge"><img src="img/png/edit.png" class="bt-table"></span></a>' :
                            data;
                    }

                }
            },
            {
                "data": "harvestID", render: function (data, type, row, meta) {
                    if (row.havest_status == "1") {
                        return type === 'display' ?
                            '<span class="badge"><img src="img/png/deleteExit.png" class="bt-table"></span>' :
                            data;
                    } else {
                        return type === 'display' ?
                            '<a type="button" id="' + data + '" class="delete-status"><span class="badge"><img src="img/png/delete.png" class="bt-table"></span></a>' :
                            data;
                    }

                }
            },

        ]
    });
    setInterval(() => {
        table.ajax.reload(null, false);
    }, 2000);

    $('#rowSelect').on('change', function () {
        fetchRowdata();
        var row_selectID = $(document).find("#rowSelect").val();
        if (row_selectID == '0') {
            row_selectID = '';
        } else {
            row_selectID = 'AND rowID = ' + row_selectID;
        }
        table.ajax.url('./db/data-farm.php?func=fetch-tableDetail&row_id=' + row_selectID);
        table.ajax.reload();
    });

    // Block Error Datatable
    $.fn.dataTable.ext.errMode = 'throw';
});


$(document).on("click", "#bt-insert", function () {
    var m_name = $(document).find("#m-name").val();
    var m_row = $(document).find("#rowSelectadd").val();
    var m_date = $(document).find("#m-date").val();
    var m_amount = $(document).find("#m-amount").val();

    if (m_name.length != '' && m_row.length != '' && m_date.length != '' && m_amount.length != '') {
        $.ajax({
            url: './db/data-farm.php',
            type: 'GET',
            data: {
                func: 'insert-farm',
                m_name: m_name,
                m_row: m_row,
                m_date: m_date,
                m_amount: m_amount
            },
            dataType: 'json',
            success: function () {
                Swal.fire({
                    icon: "success",
                    title: "เพิ่มข้อมูลเสร็จสิ้น",
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#exampleModal').modal('hide');
            }
        });
    } else {
        Swal.fire({
            icon: "error",
            title: "ข้อมูลไม่ครบถ้วน!!",
            text: "กรุณากรอกข้อมูลให้ครบถ้วน",
            confirmButtonText: "ปิด"
        });
    }
});

$("#bt-add").on("click", function () {
    $("#modal-add").load(window.location + " #modal-add");
    $('.title-edit').html("เพิ่มข้อมูลเห็ด");
    $('.bt-updaterow').attr("hidden", true);
    $('#bt-insert').removeAttr("hidden");
    $('#exampleModal').modal('show');
});

$("#row-edit").on("click", function () {
    $('#rowModal').modal('show');
    fetchrowTable();
});

$("#rowSelect").focus(function () {
    $.ajax({
        url: './db/data-farm.php',
        type: 'GET',
        data: { func: 'fetch-row', setting: 'have-mushroom' },
        dataType: 'json',
        success: function (data) {
            var srow = $('#rowSelect');
            srow.empty();
            srow.append($('<option>').text("ทั้งหมด").val("0"));

            $.each(data, function (index, row) {
                var option = $('<option>').text("แถวที่ : " + row.row_number).val(row.rowID);
                srow.append(option);
            });
        }
    });
});

$(document).on("focus", "#rowSelectadd", function () {
    $.ajax({
        url: './db/data-farm.php',
        type: 'GET',
        data: { func: 'fetch-row', setting: 'not-mushroom' },
        dataType: 'json',
        success: function (data) {
            var srow = $('#rowSelectadd');
            srow.empty();

            $.each(data, function (index, row) {
                var option = $('<option>').text("แถวที่ : " + row.row_number).val(row.rowID);
                srow.append(option);
            });
        }
    });
});

$("#row-add").on("click", function () {
    $.ajax({
        url: './db/data-farm.php',
        type: 'GET',
        data: { func: 'add-row' },
        dataType: 'json',
        success: function (data) {
            fetchrowTable();
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1200,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "เพิ่มแถวเสร็จสิ้น"
            });
        }
    });
});

$(document).on("click", ".bt-delrow", function () {
    var id = $(this).attr('id');
    var farm_id = $(this).attr('data-id');

    Swal.fire({
        title: "คุณแน่ใจที่จะลบข้อมูล หรือไม่ ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f34235",
        confirmButtonText: "ลบข้อมูล",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: './db/data-farm.php',
                type: 'GET',
                data: { func: 'del-row', id: id, farm_id: farm_id },
                dataType: 'json',
                success: function (data) {
                    fetchrowTable();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 1200,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "warning",
                        title: "ลบแถวเสร็จสิ้น"
                    });
                }
            });
        }
    });
});

$(document).on("click", ".bt-editrow", function () {
    var id = $(this).attr("id");
    $('.title-edit').html("แก้ไขข้อมูลเห็ด");

    $.ajax({
        url: './db/data-farm.php',
        type: 'GET',
        data: { func: 'get-rowedit', id: id },
        dataType: 'json',
        success: function (data) {
            $('#m-name').val(data.mushroom_name);
            $('#rowSelectadd option:selected').val(0).text('แถวที่ : ' + data.row_number);
            $('#m-date').val(data.planting_date);
            $('#m-amount').val(data.mushroom_amount);
            $('#bt-insert').attr("hidden", true);
            $('.bt-updaterow').attr({ "id": data.rowID, "data-id": data.mushroomID }).removeAttr("hidden");
        }
    });
    $('#exampleModal').modal('show');
});

$(document).on("click", ".bt-updaterow", function () {
    var id = $(this).attr("id");
    var m_id = $(this).attr("data-id");
    var m_name = $(document).find("#m-name").val();
    var m_row = $(document).find("#rowSelectadd").val();
    var m_date = $(document).find("#m-date").val();
    var m_amount = $(document).find("#m-amount").val();

    $.ajax({
        url: './db/data-farm.php',
        type: 'GET',
        data: {
            func: 'update-rowdetail',
            id: id,
            m_id: m_id,
            m_name: m_name,
            m_row: m_row,
            m_date: m_date,
            m_amount: m_amount
        },
        dataType: 'json',
        success: function () {
            Swal.fire({
                icon: "success",
                title: "แก้ไขข้อมูลเสร็จสิ้น",
                showConfirmButton: false,
                timer: 1500
            });
            $('#exampleModal').modal('hide');
        }
    });

});

$(document).on("click", ".change-status", function () {
    var id = $(this).attr("id");
    var data_id = $(this).attr("data-id");
    var data_name = $(this).attr("data-name");
    var data_m = $(this).attr("data-m");
    $('.bt-Addharvest').attr("id", id);
    $('.bt-Addharvest').attr("data-id", data_id);
    $('.bt-Addharvest').attr("data-name", data_name);
    $('.bt-Addharvest').attr("data-m", data_m);
    $('.title-table').html("เก็บเกี่ยว");
    $('#harvest-date').val("");
    $('#harvest-amount').val("");
    $('.bt-Editharvest').attr("hidden", true);
    $('.bt-Addharvest').removeAttr("hidden");
    $('#tableModal').modal('show');
});

$(document).on("click", ".bt-Addharvest", function () {
    var id = $(this).attr("id");
    var data_id = $(this).attr("data-id");
    var data_name = $(this).attr("data-name");
    var data_m = $(this).attr("data-m");
    var h_date = $(document).find("#harvest-date").val();
    var h_amount = $(document).find("#harvest-amount").val();

    if (h_date.length != '' && h_amount.length != '') {
        Swal.fire({
            title: "คุณต้องการที่จะเพาะปลูกต่อ หรือไม่ ?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#f34235",
            confirmButtonText: "ใช่",
            cancelButtonText: "ไม่ใช่"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: './db/data-farm.php',
                    type: 'GET',
                    data: {
                        func: 'add-harvestYes',
                        h_id: id,
                        h_date: h_date,
                        h_amount: h_amount,
                        m_id: data_m,
                    },
                    dataType: 'json',
                    success: function (data) {
                        Swal.fire({
                            icon: "success",
                            title: "เก็บเกี่ยวเสร็จสิ้น",
                            text: "ได้ดำเนินการเพาะปลูกต่อ",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        fetchrowTable();
                    }
                });
                $('#tableModal').modal('hide');
            } else {
                $.ajax({
                    url: './db/data-farm.php',
                    type: 'GET',
                    data: {
                        func: 'add-harvestNo',
                        h_id: id,
                        h_date: h_date,
                        h_amount: h_amount,
                        row_id: data_id,
                        row_name: data_name,
                    },
                    dataType: 'json',
                    success: function (data) {
                        Swal.fire({
                            icon: "success",
                            title: "เก็บเกี่ยวเสร็จสิ้น",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        fetchrowTable();
                    }
                });
                $('#tableModal').modal('hide');
            }
        });
    } else {
        Swal.fire({
            icon: "error",
            title: "ข้อมูลไม่ครบถ้วน!!",
            text: "กรุณากรอกข้อมูลให้ครบถ้วน",
            confirmButtonText: "ปิด"
        });
    }
});

$(document).on("click", ".edit-status", function () {
    var id = $(this).attr("id");
    $('.title-table').html("แก้ไขข้อมูลการเก็บเกี่ยว");

    $.ajax({
        url: './db/data-farm.php',
        type: 'GET',
        data: { func: 'get-harvestedit', id: id },
        dataType: 'json',
        success: function (data) {
            $('#harvest-date').val(data.havest_date);
            $('#harvest-amount').val(data.havest_product);
            $('.bt-Addharvest').attr("hidden", true);
            $('.bt-Editharvest').attr("id", data.harvestID).removeAttr("hidden");
        }
    });
    $('#tableModal').modal('show');
});

$(document).on("click", ".bt-Editharvest", function () {
    var id = $(this).attr("id");
    var h_date = $(document).find("#harvest-date").val();
    var h_amount = $(document).find("#harvest-amount").val();

    $.ajax({
        url: './db/data-farm.php',
        type: 'GET',
        data: {
            func: 'update-harvest',
            id: id,
            h_date: h_date,
            h_amount: h_amount,
        },
        dataType: 'json',
        success: function () {
            Swal.fire({
                icon: "success",
                title: "แก้ไขข้อมูลเสร็จสิ้น",
                showConfirmButton: false,
                timer: 1500
            });
            $('#tableModal').modal('hide');
        }
    });
});

$(document).on("click", ".delete-status", function () {
    var id = $(this).attr("id");

    Swal.fire({
        title: "คุณแน่ใจที่จะลบข้อมูล หรือไม่ ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f34235",
        confirmButtonText: "ลบข้อมูล",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: './db/data-farm.php',
                type: 'GET',
                data: { func: 'delete-harvest', id: id },
                dataType: 'json',
                success: function (data) {
                    Swal.fire({
                        icon: "success",
                        title: "ลบข้อมูลเสร็จสิ้น",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    });
});

function updatetableRow(data) {
    var trow = $('#table-row tbody');
    trow.empty();

    $.each(data, function (index, row) {
        var row = '<tr>' +
            '<td> แถวที่ : ' + row.row_number + '</td>' +
            '<td>' + (row.mushroom_name == null ? "ว่าง" : row.mushroom_name) + '</td>' +
            '<td class="text-center">' + '<a type="button" id="' + row.rowID + '" data-id="' + row.mushroomID + '" class="bt-delrow"><span class="badge"><img src="img/png/delete.png" class="bt-del-row"></span></a>' + '</td>' +
            '</tr>';
        trow.append(row);
    });
}

function fetchRowdata() {
    var row_id = $(document).find("#rowSelect").val();
    if (row_id == '0') {
        row_id = '';
    } else {
        row_id = 'AND rowID = ' + row_id;
    }

    $.ajax({
        url: './db/data-farm.php',
        type: 'GET',
        data: { func: 'fetch-rowDetail', row_id: row_id },
        dataType: 'json',
        success: function (data) {
            var rowFarm = $('#row-detail');
            rowFarm.empty();
            if (data.length != 0) {
                $.each(data, function (index, row) {
                    var row = '<div class="col-6 card-data-row">' +
                        '<div class="card">' +
                        '<div class="card-header">' +
                        '<h4 class="row-farm">แถวที่ &nbsp;:&nbsp; ' + row.row_number + ' </h4>' +
                        '<a href="#" class="bt-editrow" id="' + row.rowID + '"><img src="img/farm/png/edit2.png" class="rounded float-end" alt="" srcset=""></a>' +
                        '</div>' +
                        '<div class="card-body">' +
                        '<div class="row">' +
                        '<div class="col-md-3 col-6 d-flex align-items-end flex-column col-data-row">' +
                        '<h6>สายพันธุ์เห็ด &nbsp;:</h6>' +
                        '<h6>วันที่เพาะเห็ด &nbsp;:</h6>' +
                        '<h6>จำนวนก้อนเห็ด :</h6>' +
                        '</div>' +
                        '<div class="col-md-3 col-6 ps-0 col-data-row">' +
                        '<h6>' + row.mushroom_name + '</h6>' +
                        '<h6>' + row.plan_date + '</h6>' +
                        '<h6>' + row.mushroom_amount + '</h6>' +
                        '</div>' +
                        '<div class="col-md-3 col-6 d-flex align-items-end flex-column col-data-row">' +
                        '<h6>ผลผลิตรวม &nbsp;:</h6>' +
                        '<h6>เก็บเกี่ยวแล้ว &nbsp;:</h6>' +
                        '</div>' +
                        '<div class="col-md-3 col-6 ps-0 col-data-row">' +
                        '<h6>' + (row.havest_product == null ? "--" : row.havest_product + "&nbsp; กิโลกรัม") + '</h6>' +
                        '<h6>' + (row.havest_status == null ? "--" : row.havest_status + "&nbsp; ครั้ง") + '</h6>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    rowFarm.append(row);
                });
            } else {
                rowFarm.append('<h6>&nbsp; &nbsp; &nbsp;ไม่พบข้ออมูล</h6>');
            }
        }
    });

}

function fetchrowTable() {
    $.ajax({
        url: './db/data-farm.php',
        type: 'GET',
        data: { func: 'fetch-row', setting: 'all-on' },
        dataType: 'json',
        success: function (data) {
            updatetableRow(data);
        }
    });
}
