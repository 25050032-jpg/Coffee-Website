function showForm(formId) {
    // Hide all form boxes
    document.querySelectorAll(".form-box").forEach(form => form.classList.remove("active"));
    
    // Select the target container by ID and add the 'active' class
    const targetForm = document.getElementById(formId);
    if (targetForm) {
        targetForm.classList.add("active");
    }
}