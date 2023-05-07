var dateToday = new Date();
var unavailableDates = ["19-6-2023","20-6-2023", "21-6-2023", "22-6-2023", "23-6-2023", "24-6-2023", "25-6-2023", "26-6-2023", "27-6-2023", "28-6-2023" , "29-6-2023" , "30-6-2023" ];

function unavailable(date) {
    dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
    if ($.inArray(dmy, unavailableDates) == -1) {
        return [true, ""];
    } else {
        return [false, "", "Unavailable"];
    }
}
$('#check_in').datetimepicker({
    format: "d/m/Y",
    formatTime: "",
    timepicker: 0,
    beforeShowDay: unavailable,
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});
$('#check_out').datetimepicker({
    format: "d/m/Y",
    formatTime: "",
    timepicker: 0,
    beforeShowDay: unavailable,
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});