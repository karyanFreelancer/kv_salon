document.addEventListener("DOMContentLoaded", () => {

    /* =====================================================
       DATE
    ===================================================== */

    const dateInput =
        document.getElementById("booking-date");


    if (dateInput) {

        const today =
            new Date().toISOString().split("T")[0];

        dateInput.min = today;

    }



    /* =====================================================
       PHONE
    ===================================================== */

    const phoneInput =
        document.getElementById("booking-phone");


    if (phoneInput) {

        phoneInput.addEventListener("input", () => {

            phoneInput.value =
                phoneInput.value
                    .replace(/\D/g, "")
                    .slice(0, 10);

        });

    }



    /* =====================================================
       QUICK TIME
    ===================================================== */

    const timeInput =
        document.getElementById("booking-time");

    const timeButtons =
        document.querySelectorAll(
            ".time-buttons button"
        );


    timeButtons.forEach(button => {

        button.addEventListener("click", () => {

            const selectedTime =
                button.dataset.time;


            if (timeInput) {

                timeInput.value =
                    selectedTime;

            }


            timeButtons.forEach(btn => {

                btn.classList.remove("active");

            });


            button.classList.add("active");


            updateSummary();

        });

    });



    /* =====================================================
       SUMMARY
    ===================================================== */

    const serviceSelect =
        document.getElementById("service_id");

    const summaryService =
        document.getElementById("summaryService");

    const summaryDate =
        document.getElementById("summaryDate");

    const summaryTime =
        document.getElementById("summaryTime");


    function updateSummary() {

        /* SERVICE */

        if (
            serviceSelect &&
            serviceSelect.value
        ) {

            const option =
                serviceSelect.options[
                    serviceSelect.selectedIndex
                ];


            summaryService.textContent =
                option.textContent.trim();

        } else {

            summaryService.textContent =
                "Not selected";

        }



        /* DATE */

        if (
            dateInput &&
            dateInput.value
        ) {

            const date =
                new Date(
                    dateInput.value + "T00:00:00"
                );


            summaryDate.textContent =
                date.toLocaleDateString(
                    "en-IN",
                    {
                        day: "2-digit",
                        month: "short",
                        year: "numeric"
                    }
                );

        } else {

            summaryDate.textContent =
                "Not selected";

        }



        /* TIME */

        if (
            timeInput &&
            timeInput.value
        ) {

            const [hours, minutes] =
                timeInput.value.split(":");


            const date =
                new Date();

            date.setHours(
                Number(hours),
                Number(minutes)
            );


            summaryTime.textContent =
                date.toLocaleTimeString(
                    "en-US",
                    {
                        hour: "numeric",
                        minute: "2-digit"
                    }
                );

        } else {

            summaryTime.textContent =
                "Not selected";

        }

    }



    if (serviceSelect) {

        serviceSelect.addEventListener(
            "change",
            updateSummary
        );

    }


    if (dateInput) {

        dateInput.addEventListener(
            "change",
            updateSummary
        );

    }


    if (timeInput) {

        timeInput.addEventListener(
            "change",
            () => {

                timeButtons.forEach(button => {

                    button.classList.remove(
                        "active"
                    );

                });

                updateSummary();

            }
        );

    }



    /* =====================================================
       FORM VALIDATION
    ===================================================== */

    const form =
        document.getElementById("bookingForm");


    if (form) {

        form.addEventListener(
            "submit",
            event => {

                const phone =
                    phoneInput.value.trim();


                if (phone.length !== 10) {

                    event.preventDefault();


                    phoneInput.focus();


                    alert(
                        "Please enter a valid 10 digit phone number."
                    );


                    return;

                }


                if (
                    !serviceSelect.value ||
                    !dateInput.value ||
                    !timeInput.value
                ) {

                    event.preventDefault();


                    alert(
                        "Please select service, date and time."
                    );

                }

            }
        );

    }


});