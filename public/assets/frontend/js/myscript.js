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
    dmy = String(date.getDate()).padStart(2, '0') + "-"
        + String(date.getMonth() + 1).padStart(2, '0') + "-" + date.getFullYear();
    if ($.inArray(dmy, unavailableDates) == -1) {      
        return [true, ""];
    } else {       
        return [false, "", "Unavailable"];
    }
}


    // Helper function to parse d/m/Y H:i to Date object
    function parseDateDMY(dateStr) {
        const [day, month, year] = dateStr.split(/[/-]/).map(Number);
        const date = new Date(year, month - 1, day);
        date.setHours(0, 0, 0, 0);
        return date;
    }


     // Function to check if any disabled date is within the range
     function isDisabledDateInRange(startDate, endDate) {
        const start = startDate instanceof Date ? parseDateDMY(`${startDate.getDate()}/${startDate.getMonth() + 1}/${startDate.getFullYear()}`) : parseDateDMY(startDate);
        const end = endDate instanceof Date ? parseDateDMY(`${endDate.getDate()}/${endDate.getMonth() + 1}/${endDate.getFullYear()}`) : parseDateDMY(endDate);

        console.log(start);
        console.log(end);

        for (const date of unavailableDates) {
            const disabledDate = parseDateDMY(date);
            if (disabledDate >= start && disabledDate <= end) {
                return true;
            }
        }
        return false;
    }



const today = new Date();
today.setHours(0, 0, 0, 0);

$('#check_in').datetimepicker({
    format: "d/m/Y",
    formatTime: "",
    timepicker: 0,
    minDate: today,
    beforeShowDay: unavailable,
    onSelectDate: function(selectedDate) {
        selectedDate.setHours(0, 0, 0, 0);
        $('#check_out').datetimepicker('setOptions', { minDate: selectedDate });

        const checkoutDate = parseDateDMY($('#check_out').val());
        if ($('#check_out').val() && checkoutDate < selectedDate) {
            $('#check_out').val('');
        }
    }

});
$('#check_out').datetimepicker({
    format: "d/m/Y",
    formatTime: "",
    timepicker: 0,
    minDate: today,
    beforeShowDay: unavailable,
    onSelectDate: function(selectedDate) {

        const startDate = parseDateDMY($('#check_in').val());

        if (!startDate) {
            alert("Select Check In date");
            $('#check_out').val('');
            return;
        }

            // Check if there’s a disabled date between start and end dates
            if (selectedDate < startDate) {
                alert("Check-out date cannot be before the check-in date.");
                $('#check_out').val('');
            } else if (isDisabledDateInRange(startDate, selectedDate)) {
                alert("The selected date range includes a disabled date. Please choose a different range.");
                $('#check_out').val('');  // Clear the selected end date if it’s invalid
            } 
    }
});

