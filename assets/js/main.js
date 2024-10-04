document.addEventListener('DOMContentLoaded', function() {
    // Edit Profile Form Submission
    const editProfileForm = document.getElementById('editProfileForm');
    if (editProfileForm) {
        editProfileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Here you would typically send the form data to a server
            console.log('Profile updated');
            alert('Profile updated successfully!');
        });
    }

    // Change Password Form Submission
    const changePasswordForm = document.getElementById('changePasswordForm');
    if (changePasswordForm) {
        changePasswordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            if (newPassword !== confirmPassword) {
                alert('New passwords do not match!');
                return;
            }
            // Here you would typically send the new password to a server
            console.log('Password changed');
            alert('Password changed successfully!');
        });
    }
});
