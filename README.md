Student Grade Submission Portal

A simple web-based system for submitting student details and subject marks.
The project uses HTML, CSS, JavaScript (Fetch API), and PHP to store and display student records.

🚀 Features

Submit student information (name, ID, gender, age).

Enter marks for five subjects.

Data is processed by PHP (roster.php).

Success and error alerts using JavaScript.

Option to view all submitted students.

Clean user interface.

📁 Project Structure
├── index.html         # Main form UI  
├── roster.css         # Page stylesheet  
├── roster.js          # Form submission + alerts  
├── roster.php         # Backend logic (saving/viewing records)  
└── README.md          # Documentation  

🛠️ Technologies Used

HTML5

CSS3

JavaScript (Fetch API)

PHP

JSON / Tables (Optional for display)

📥 How It Works

1️⃣ Fill Out the Form

Users can enter full name, ID, gender, age, and marks for each subject.

2️⃣ Submit Data

JavaScript sends the form using:

fetch("roster.php", { method: "POST", body: formData })

3️⃣ PHP Processes Input

Validates inputs

Saves data (database or file, depending on setup)

Returns success or error text


Alerts Displayed

Green alert = success

Red alert = error

🖥️ Setup Instructions

✔️ Requirements

PHP installed (XAMPP, WAMP, or local server)

Browser

Folder placed inside htdocs (for XAMPP)

✔️ Steps

Download or clone the repository:

git clone https://github.com/yourusername/student-grade-submission.git


Move the folder into:

C:\xampp\htdocs\


Start Apache server (from XAMPP).

Open the project in the browser:

http://localhost/student-grade-submission/

📄 Viewing Student Roster

Inside the portal, click:

"View Student Roster"
This loads data stored by the PHP backend.

🧩 Customization

You can extend this project by adding:

Database (MySQL) instead of file storage

GPA calculation

Edit/delete student data

Authentication system

🤝 Contributions

Pull requests are welcome!
For major changes, please open an issue to discuss ideas first.

📜 License

This project is open-source and available under the MIT License.
