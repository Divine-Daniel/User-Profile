<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .profile-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 800px;
            margin: 0 auto;
        }
        .profile-header {
            background-color: #3498db;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .profile-name {
            font-size: 24px;
            margin: 0;
        }
        .profile-title {
            font-size: 16px;
            margin: 5px 0 0;
            opacity: 0.8;
        }
        .profile-content {
            padding: 20px;
        }
        .profile-tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .profile-tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 2px solid transparent;
        }
        .profile-tab.active {
            border-bottom-color: #3498db;
        }
        .profile-form {
            display: grid;
            gap: 15px;
            grid-template-columns: 1fr 1fr;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .edit-button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <img src="/api/placeholder/150/150" alt="Profile Picture" class="profile-picture">
            <h1 class="profile-name">Jane Doe</h1>
            <p class="profile-title">Software Developer</p>
        </div>
        <div class="profile-content">
            <div class="profile-tabs">
                <div class="profile-tab active">Account</div>
                <div class="profile-tab">Security</div>
                <div class="profile-tab">Preferences</div>
            </div>
            <form class="profile-form">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" value="Jane">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" value="Doe">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" value="jane.doe@example.com">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" value="+1 234 567 8900">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role">
                        <option>Software Developer</option>
                        <option>Designer</option>
                        <option>Project Manager</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="department">Department</label>
                    <select id="department">
                        <option>Engineering</option>
                        <option>Design</option>
                        <option>Marketing</option>
                    </select>
                </div>
            </form>
            <button class="edit-button">Save Changes</button>
        </div>
    </div>
    <script>
        // Add interactivity here
        document.querySelectorAll('.profile-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelector('.profile-tab.active').classList.remove('active');
                tab.classList.add('active');
                // Here you would typically update the form content based on the selected tab
            });
        });
    </script>
</body>
</html>
