/**
 * TABLE REORDER
 * ------------------
 */

// hide Column List
Sortable.create(hideColumnList, {
    group: 'bar',
    animation: 100
});

// show Column List
Sortable.create(showColumnList, {
    group: 'bar',
    animation: 100
});

// show Column List
Sortable.create(showColumnListShortVers, {
    group: 'bar',
    animation: 100
});

// Variable Initialisatio
//localStorage.removeItem(storage_name);
if(localStorage.getItem(storage_name) === null) {
    var columns = all_columns;
    localStorage.setItem(storage_name, JSON.stringify(columns));
}
var data_local = JSON.parse(localStorage.getItem(storage_name));

// Set table column order based on option that have placed in showColumnList
function set_table_column() {
    var columns = []; var i=0;
    $('#showColumnList .list-group-item').each(function() {
        columns[i] = $(this).attr('class').split('list-group-item ')[1];
        i++;
    });
    if(i==0){
        alert("Kolom yang ditampilkan tidak boleh kosong");
    } else {
        localStorage.setItem(storage_name, JSON.stringify(columns));
        reload_table();
        set_column_short_order();
    }
    set_column_height();
}

function set_column_height() {
    var showColumn = $('#showColumnList').height();
    var hideColumn = $('#hideColumnList').height();
    if(hideColumn > showColumn) {
        $('#showColumnList').height(hideColumn);
    } else {
        $('#hideColumnList').height(showColumn);
    }
}
// Reload table
function reload_table() {
    data_local = JSON.parse(localStorage.getItem(storage_name));
    $("#tabel").css("display","none");
    set_display();
    set_table_order();
    $("#tabel").fadeIn();
}

// reload column order tool
function reload_column_tool() {
    $("#listColumn").css("display","none");
    $("#showColumnList").append($('#hideColumnList').html());
    $("#hideColumnList").html('');
    set_column_tool_order();
    $("#listColumn").fadeIn();
    set_column_height();
}

// Reset table column config (show all column)
function reset_table_column() {
    localStorage.setItem(storage_name, JSON.stringify(all_columns));
    data_local = JSON.parse(localStorage.getItem(storage_name));
    reload_table();
    reload_column_tool();
    set_column_height();
}

// Set table order
function set_display() {
    for(var b = 0; b < all_columns.length; b++){
        if(data_local.indexOf(all_columns[b]) == -1){ // not exist
            $('table .'+all_columns[b]).css("display","none");
            $("#hideColumnList").append($("#showColumnList ."+all_columns[b]));
        } else {
            $('table .'+all_columns[b]).css("display","");
        }
    }
}

// Set table column order
function set_table_order() {
    $('table tr').each(function() {
        var col_array = data_local;
        var tr = $(this);
        for(var b = col_array.length-1; b >= 1; b--){
            var col_a = $('.'+col_array[b-1]);
            var col_b = $('.'+col_array[b]);

            var tda = tr.find(col_a);
            var tdb = tr.find(col_b);
            tda.detach().insertBefore(tdb);
        }
    });
}

// Set column tool order
function set_column_tool_order() {
    $('#showColumnList').each(function() {
        var col_array = data_local;
        var tr = $(this);
        for(var b = col_array.length-1; b >= 1; b--){
            var a = b-1;
            var tda = tr.find($('.'+col_array[a]));
            var tdb = tr.find($('.'+col_array[b]));
            tda.detach().insertBefore(tdb);
        }
    });
    set_column_short_order();
}

function set_column_short_order() {

    $('#showColumnListShortVers').each(function() {
        var col_array = data_local;
        var tr = $(this);
        for(var b = col_array.length-1; b >= 1; b--){
            var a = b-1;
            var tda = tr.find($('.'+col_array[a]));
            var tdb = tr.find($('.'+col_array[b]));
            tda.detach().insertBefore(tdb);
        }
    });

    var n_show = 0;
    for(var b = 0; b < all_columns.length; b++){
        if(data_local.indexOf(all_columns[b]) == -1){ // not exist
            $('#showColumnListShortVers .'+all_columns[b]).css("display","none");
        } else {
            if(n_show <= 10)
                $('#showColumnListShortVers .'+all_columns[b]).css("display","");
            else
                $('#showColumnListShortVers .'+all_columns[b]).css("display","none");
            n_show++;
        }
    }
}

// Init call function
set_display();
set_table_order();
set_column_tool_order();