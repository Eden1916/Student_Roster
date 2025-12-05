document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form");
    const alertBox = document.getElementById("successAlert");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(form);

        fetch("roster.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {

            // If PHP returns an error
            if (data.includes("ERROR")) {
                alertBox.textContent = data;
                alertBox.style.background = "#dc3545"; // RED
                alertBox.style.color = "white";
                alertBox.style.display = "block";

                setTimeout(() => {
                    alertBox.style.display = "none";
                    alertBox.style.background = "#28a745"; // Reset GREEN
                }, 3000);

                return;
            }

            // SUCCESS CASE
            alertBox.textContent = "Student data saved successfully!";
            alertBox.style.background = "#28a745";  // GREEN
            alertBox.style.color = "white";
            alertBox.style.display = "block";

            setTimeout(() => {
                alertBox.style.display = "none";
            }, 3000);

            form.reset();
        });
    });
});
