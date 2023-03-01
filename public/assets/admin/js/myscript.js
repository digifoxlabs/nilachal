var dateToday = new Date();
var unavailableDates = ["20-6-2019", "21-6-2019", "22-6-2019", "23-6-2019", "24-6-2019", "25-6-2019", "26-6-2019", "27-6-2019"];

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
    onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});