$(function() {
    var from = $("#start_date")
        .datepicker({
            dateFormat: "yy-mm-dd"
            , maxDate: "now"
            , changeMonth: true
            , changeYear: true
        }).on("change", function() {
            to.datepicker("option", "minDate", getDate(this));
        }),

        to = $("#end_date").datepicker({
            dateFormat: "yy-mm-dd"
            , maxDate: "now"
            , changeMonth: true
            , changeYear: true
        }).on("change", function() {
            from.datepicker("option", "maxDate", getDate(this));
        });

    function getDate(element) {
        var date;
        var dateFormat = "yy-mm-dd";
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }

        return date;
    }
});

$(function() {
    var fromMs = $("#microsoft_start_date")
        .datepicker({
            dateFormat: "yy-mm-dd"
            , maxDate: "now"
            , changeMonth: true
            , changeYear: true
        }).on("change", function() {
            toMs.datepicker("option", "minDate", getDateMs(this));
        }),

        toMs = $("#microsoft_end_date").datepicker({
            dateFormat: "yy-mm-dd"
            , maxDate: "now"
            , changeMonth: true
            , changeYear: true
        }).on("change", function() {
            fromMs.datepicker("option", "maxDate", getDateMs(this));
        });

    function getDateMs(element) {
        var date;
        var dateFormat = "yy-mm-dd";
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }

        return date;
    }
});
