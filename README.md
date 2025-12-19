📘 Student Grade Submission Portal

A simple web-based system for submitting student details and subject marks.
Built with HTML, CSS, JavaScript (Fetch API), and PHP.

🚀 Features

Submit student information (name, ID, gender, age).

Enter marks for five subjects (Maths, English, Biology, Physics, Chemistry).

Data validation with success (green) and error (red) alerts.

View all submitted student records in a table.

Clean and user-friendly interface.

📁 Project Structure

├── index.html             # Main form interface

├── roster.css             # Page styling

├── roster.js              # JavaScript for form submission and alerts

├── roster.php             # Backend PHP logic for saving/viewing records

└── README.md              # Project documentation

🛠️ Technologies Used

HTML5

CSS3

JavaScript (Fetch API)

PHP

📥 Setup Instructions
Requirements

Local server with PHP (e.g., XAMPP, WAMP, MAMP)

Web browser

Steps

Clone or download the repository:

git clone https://github.com/yourusername/student-grade-submission.git


Place the folder inside your local server directory (e.g., C:\xampp\htdocs\).

Start your local server (Apache).

Open your browser and go to:

http://localhost/student-grade-submission/index.html

📄 How It Works

Fill Out the Form – Enter student information and marks.

Submit Data – The form is sent via JavaScript (fetch) to roster.php.

PHP Processes Input – Data is validated and saved to the database.

Alerts Displayed –

Green box = successful submission

Red box = invalid input or error

View Roster – Click “View Student Roster” to see all stored records.

🧩 Customization Ideas

Connect to a MySQL database instead of storing in a file.

Add edit/delete functionality for students.

Include GPA calculation or grade analytics.

Implement authentication for multiple users.

📜 License

This project is open-source and available under the MIT License.
