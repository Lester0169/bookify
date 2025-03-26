<script>
// Function to search through the table
function searchTable() {
    const input = document.getElementById('search-input').value.toLowerCase();
    const rows = document.querySelectorAll('#renter-table tr');

    rows.forEach(row => {
        const columns = row.querySelectorAll('td');
        let match = false;

        columns.forEach((column, index) => {
            if (column.textContent.toLowerCase().includes(input)) {
                match = true;
            }
        });

        if (match) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Function to handle the view details modal
function viewDetails(button) {
    const row = button.closest('tr');
    const renterId = row.querySelector('td').textContent; // Get RenterId from first cell

    const userId = row.getAttribute('data-userId');
    const idType = row.getAttribute('data-idType');
    const validId = row.getAttribute('data-validId');
    const selfieId = row.getAttribute('data-selfieId');
    const socialLinks = row.getAttribute('data-socialLinks');

    // Populate modal with data
    document.getElementById('modal-user-id').textContent = userId;
    document.getElementById('modal-id-type').textContent = idType;
    document.getElementById('modal-valid-id').textContent = validId;
    document.getElementById('modal-selfie-id').textContent = selfieId;
    document.getElementById('modal-social-links').textContent = socialLinks;
    document.getElementById('modal-country').textContent = row.cells[3].textContent; // Country
    document.getElementById('modal-city').textContent = row.cells[4].textContent; // City
    document.getElementById('modal-barangay').textContent = row.cells[5].textContent; // Barangay
    document.getElementById('modal-address').textContent = row.cells[6].textContent; // Address
    document.getElementById('modal-contact').textContent = row.cells[7].textContent; // Contact Number
    document.getElementById('modal-email').textContent = row.cells[8].textContent; // Email

    // Store RenterId in the modal
    document.getElementById('modal-approve-btn').setAttribute('data-renter-id', renterId);
    document.getElementById('modal-decline-btn').setAttribute('data-renter-id', renterId);

    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('viewModal'));
    modal.show();
}

// Function to approve a renter
function approveRenter(renterId) {
    if (confirm('Are you sure you want to approve this renter?')) {
        // Send approval request to server
        fetch('process_verification.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'approve',
                renterId: renterId
            })
        })
        .then(response => response.text())
        .then(result => {
            if (result.trim() === 'success') {
                alert('Renter approved successfully.');
                location.reload();
            } else {
                alert('Failed to approve renter.');
            }
        });
    }
}

// Function to decline a renter
function declineRenter(renterId) {
    if (confirm('Are you sure you want to decline this renter?')) {
        // Send decline request to server
        fetch('process_verification.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'decline',
                renterId: renterId
            })
        })
        .then(response => response.text())
        .then(result => {
            if (result.trim() === 'success') {
                alert('Renter declined successfully.');
                location.reload();
            } else {
                alert('Failed to decline renter.');
            }
        });
    }
}

// Event listener for modal approval button
document.getElementById('modal-approve-btn').addEventListener('click', function() {
    const renterId = this.getAttribute('data-renter-id');
    approveRenter(renterId);
});

// Event listener for modal decline button
document.getElementById('modal-decline-btn').addEventListener('click', function() {
    const renterId = this.getAttribute('data-renter-id');
    declineRenter(renterId);
});
</script>
