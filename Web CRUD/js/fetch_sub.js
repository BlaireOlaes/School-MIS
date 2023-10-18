$(document).ready(function () {
    const scheduleOptions = {
        Mth: ["7:30-9:00", "9:00-10:30", "10:30-12:00", "1:00-2:30", "2:30-4:00", "4:00-5:30", "5:30-7:00"],
        TF: ["7:30-9:00", "9:00-10:30", "10:30-12:00", "1:00-2:30", "2:30-4:00", "4:00-5:30", "5:30-7:00"],
        W: ["8:00-10:00", "10:00-12:00", "1:00-3:00", "3:00-5:00", "5:00-7:00"],
        S: ["8:00-10:00", "10:00-12:00", "1:00-3:00", "3:00-5:00", "5:00-7:00"]
    };
    const scheduleDayDropdown = $("#schedule-day");
    const scheduleTimeDropdown = $("#schedule-time");
    scheduleDayDropdown.on("change", function () {
        const selectedDay = $(this).val();
        const options = scheduleOptions[selectedDay];
        scheduleTimeDropdown.empty();
        options.forEach(function (option) {
            scheduleTimeDropdown.append($("<option>", {
                value: option,
                text: option
            }));
        });
    });
    scheduleDayDropdown.trigger("change");
});

$(document).ready(function () {
    $("#addButton").click(function () {
        $("#addPersonModal").modal("show");
    });
});

// AJAX request to fetch subject name based on subject code
$("#ins_subcode").on("input", function () {
    const subjectCode = $(this).val();
    if (subjectCode !== "") {
        $.ajax({
            type: "POST",
            url: "../backend/fetch_sub.php", // Replace with the actual path to your PHP file
            data: { subjectCode: subjectCode },
            success: function (response) {
                // Update the subject name input with the fetched name
                $("#ins_sname").val(response);
            },
            error: function () {
                // Handle errors if needed
            }
        });
    }
});

