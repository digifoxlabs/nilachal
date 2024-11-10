var dateToday = new Date();
// var unavailableDates = ["11-11-2024"];

var baseUrl = document.getElementById('base-url').getAttribute('data-url');

console.log(baseUrl);

let unavailableDates = [];
// Function to get disabled dates from the server
function fetchDisabledDates() {
    $.ajax({
        url: baseUrl+ '/bookings/getdisableonlinedates',  // The URL of the route
        type: 'GET',
        dataType: 'json',  // Expect a JSON response
        success: function(response) {
            if (response.status === 'success') {
                console.log('Disabled Dates:', response.disabledDates);  // Handle the disabled dates
                // Now, you can use the disabled dates for your datetime picker or other purposes

        // Assign the array of disabled dates from the server to the JS variable
            unavailableDates = response.disabledDates.map(date => formatDate(date));
   


            } else {
                console.error('Failed to fetch disabled dates:', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
        }
    });
}

// Call the function to fetch disabled dates
fetchDisabledDates();



// Function to format date as dd-mm-yyyy
function formatDate(dateString) {
    const date = new Date(dateString);
    const day = String(date.getDate()).padStart(2, '0');  // Get day and pad with 0
    const month = String(date.getMonth() + 1).padStart(2, '0');  // Get month (0-indexed) and pad with 0
    const year = date.getFullYear();
    return `${day}-${month}-${year}`;
}



// fetch(fetchDisabledDatesUrl)
// .then(response => response.json())
// .then(data => {
//     // Assign the array of disabled dates from the server to the JS variable
//     unavailableDates = data.disabledDates.map(date => formatDate(date));
   
// })
// .catch(error => console.error("Error fetching disabled dates:", error));


function unavailable(date) {
    dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
    if ($.inArray(dmy, unavailableDates) == -1) {      
        return [true, ""];
    } else {       
        return [false, "", "Unavailable"];
    }
}


    // Helper function to parse d/m/Y H:i to Date object
    function parseDateDMY(dateStr) {
        const [day, month, year] = dateStr.split("-");
        return new Date(`${year}-${month}-${day}`);      
    }


    // Helper function to parse date from d/m/Y format and return in d-m-Y format
    function formatToDMY(dateStr) {
    const [day, month, year] = dateStr.split("/");
    return `${day}-${month}-${year}`;
}



     // Function to check if any disabled date is within the range
     function isDisabledDateInRange(startDate, endDate) {
        const start = parseDateDMY(startDate);
        const end = parseDateDMY(endDate);

        console.log(start);
        console.log(end);

        for (const date of unavailableDates) {
            const disabledDate = parseDateDMY(date);
            if (disabledDate > start && disabledDate < end) {
                return true;
            }
        }
        return false;
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
    onSelectDate: function(selectedDate) {

        const startDateStr = $('#check_in').val();

        if(startDateStr == ''){
            alert("Select Check In date");
        }            

        const endDateStr = $('#check_out').val();

        const formattedStartDate = formatToDMY(startDateStr.split(" ")[0]);
        const formattedEndDate = formatToDMY(endDateStr.split(" ")[0]);  

            // Check if there’s a disabled date between start and end dates
            if (isDisabledDateInRange(formattedStartDate, formattedEndDate)) {
                alert("The selected date range includes a disabled date. Please choose a different range.");
                $('#check_out').val('');  // Clear the selected end date if it’s invalid
            } 
            
            else {
                var option = this.id == "from" ? "minDate" : "maxDate",
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            }
   
        
    }
});

