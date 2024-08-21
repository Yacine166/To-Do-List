import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    // Function to toggle the status
    function toggleStatus(id, button) {
        console.log('--------- i am here ------------');
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/toggleStatus/${id}`, {
            method: 'POST', // Ensure this matches the route definition
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                // No need to send _method here if you're using POST
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                button.classList.toggle('btn-success');
                button.classList.toggle('btn-secondary');
                button.textContent = data.is_completed ? 'Completed' : 'In Completed';
            } else {
                alert('Failed to update status');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Attach event listeners to input fields
    const getTitle = document.getElementById('getTitle');
    const getDesc = document.getElementById('getDesc');

    if (getTitle) {
        getTitle.addEventListener('change', function () {
            var val = getTitle.value;
            document.getElementById("inputTitle").value = val;
        });
    }

    if (getDesc) {
        getDesc.addEventListener('change', function () {
            var val = getDesc.value;
            document.getElementById("inputDescr").value = val;
        });
    }

    // Expose the toggleStatus function to the global scope if needed in HTML
    window.toggleStatus = toggleStatus;
     
});
