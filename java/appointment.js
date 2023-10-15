//Appointment scheduling page

// Get the current date
const currentDate = new Date();

// Get the table body to generate calendar days
const tableBody = document.querySelector('.calendar-table tbody');

// Function to generate the calendar
function generateCalendar(year, month) {
    // Clear the table body
    tableBody.innerHTML = '';

    // Set the calendar to the 1st of the given month
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);

    // Get the number of days in the month
    const daysInMonth = lastDay.getDate();

    // Create a variable to track the day of the week
    let dayOfWeek = firstDay.getDay();

    // Create rows and cells for the calendar
    let row = document.createElement('tr');

    // Create empty cells for days before the 1st of the month
    for (let i = 0; i < dayOfWeek; i++) {
        const cell = document.createElement('td');
        cell.textContent = '';
        row.appendChild(cell);
    }

    // Loop through the days of the month
    for (let day = 1; day <= daysInMonth; day++) {
        const cell = document.createElement('td');
        cell.textContent = day;

        // Add additional classes for today, past, and upcoming days
        if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day === currentDate.getDate()) {
            cell.classList.add('today');
        } else if (year < currentDate.getFullYear() || (year === currentDate.getFullYear() && month < currentDate.getMonth()) || (year === currentDate.getFullYear() && month === currentDate.getMonth() && day < currentDate.getDate())) {
            cell.classList.add('past');
        } else {
            cell.classList.add('upcoming');
        }

        // Add additional class for weekends (Saturdays and Sundays)
        if (dayOfWeek === 0 || dayOfWeek === 6) {
            cell.classList.add('weekend');
        }

        // Append the cell to the row
        row.appendChild(cell);

        // If it's the last day of the week, start a new row
        if (dayOfWeek === 6 || day === daysInMonth) {
            tableBody.appendChild(row);
            row = document.createElement('tr');
        }

        // Increment the day of the week
        dayOfWeek = (dayOfWeek + 1) % 7;
    }
}

// Call the generateCalendar function with the current year and month
generateCalendar(currentDate.getFullYear(), currentDate.getMonth());


document.getElementById("Notifications").onclick = function(){

    confirm("Do you want to allow Notifications from DoseGuardian");
}

document.getElementById("support").onclick = function(){

    alert("Get you Medical support using COntact US page... Thank you!!!!");
    window.location="contactUs.php";    
}
