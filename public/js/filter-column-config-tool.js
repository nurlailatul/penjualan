
// Show column tools feature
function show_column_tool() {
    $("#btn_column_tool").attr("onClick","hide_column_tool()");
    $("#column_tool_info").css("display","none");
    $("#column_tool").fadeIn();
}
// Hide column tools feature
function hide_column_tool() {
    $("#btn_column_tool").attr("onClick","show_column_tool()");
    $("#column_tool").css("display","");
    set_column_tool_order();
    $("#column_tool_info").fadeIn();
}

// Show filter advanced tools
function show_filter_tool() {
    $("#btn_filter_tool").html('<i class="fa fa-search-minus"></i> Pencarian Sederhana');
    $("#btn_filter_tool").attr("onClick","hide_filter_tool()");
    $("#filter_lanjutan").fadeIn();
}

// Hide column tools feature
function hide_filter_tool() {
    $("#btn_filter_tool").html('<i class="fa fa-search-plus"></i> Pencarian Lanjutan');
    $("#btn_filter_tool").attr("onClick","show_filter_tool()");
    $("#filter_lanjutan").fadeOut();
}