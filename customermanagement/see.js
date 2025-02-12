// Function to fetch data from fetch_customers.php
function loadCustomers() {
    $.ajax({
        url: "fetch_customers.php",
        method: "GET",
        dataType: "json",
        success: function (data) {
            if (data.error) {
                console.error(data.error);
                return;
            }

            let tableBody = $("#searchableTable tbody");
            tableBody.empty();

            data.forEach((customer) => {
                let customerImage = customer.customerimage
                    ? `../asset/customers/${customer.customerimage}`
                    : "../asset/customers/default.jpg"; // Fallback image

                let row = `
                    <tr>
                        <td>
                            <img src="${customerImage}" class="avatar me-2" alt="Customer">
                            <a class="text-dark fw-semibold">${customer.fullname}</a>
                        </td>
                        <td>${customer.customerid}</td>
                        <td>${customer.customernumber}</td>
                        <td>${customer.email}</td>
                        <td>${customer.location}</td>
                        <td>
                       

                
                         
                         <!-- add Button -->
                            <button type="button" class="btn btn-sm btn-square btn-neutral text-success-hover">
        <i class="bi bi-plus-circle"></i>
    </button>
 <!-- edit Button -->
     <button onclick="openEditModal(${customer.customerid})" class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>

                             <button type="button" onclick="window.location.href='edit_user.php?customerid=${customer.customerid}'" class="btn btn-sm btn-square btn-neutral text-info-hover">
        <i class="bi bi-eye"></i>
    </button>
  <!-- View Button -->

   
                        


    <!-- Delete Button -->
    <button type="button" onclick="showSweetAlert()" class="btn btn-sm btn-square btn-neutral text-danger-hover">
        <i class="bi bi-trash"></i>
    </button>
                        </td>
                    </tr>
                `;
                tableBody.append(row);
            });
        },
        error: function (xhr, status, error) {
            console.error("Failed to fetch customer data:", error);
        },
    });
}

// Function to open popup with customer details
function viewCustomer(image, name, email) {
    $("#popupImage").attr("src", image);
    $("#popupName").text(name);
    $("#popupEmail").text(email);
    $("#viewPopup").fadeIn();
}

// Function to close the popup
function closePopup() {
    $("#viewPopup").fadeOut();
}

// Function to delete customer
function deleteCustomer(customerid) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to recover this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "delete_customer.php",
                method: "POST",
                data: { customerid: customerid },
                success: function (response) {
                    Swal.fire("Deleted!", "Customer has been deleted.", "success");
                    loadCustomers(); // Refresh the table
                },
                error: function () {
                    Swal.fire("Error!", "Something went wrong.", "error");
                }
            });
        }
    });
}



function editCustomer(customerid) {
    $.ajax({
        url: "fetch_single_customer.php",
        method: "POST",
        data: { customerid: customerid },
        dataType: "json",
        success: function (data) {
            if (data.error) {
                console.error(data.error);
                return;
            }

            $("#editCustomerId").val(data.customerid);
            $("#editFullname").val(data.fullname);
            $("#editEmail").val(data.email);
            $("#editNumber").val(data.customernumber);
            $("#editLocation").val(data.location);
            
            $("#editModal").fadeIn();
        },
        error: function () {
            Swal.fire("Error!", "Failed to fetch customer details.", "error");
        }
    });
}

// Function to close edit modal
function closeEditModal() {
    $("#editModal").fadeOut();
}

// Function to update customer details
$("#editCustomerForm").submit(function (e) {
    e.preventDefault();
    let formData = $(this).serialize();

    $.ajax({
        url: "update_customer.php",
        method: "POST",
        data: formData,
        success: function (response) {
            Swal.fire("Updated!", "Customer details have been updated.", "success");
            closeEditModal();
            loadCustomers(); // Refresh table
        },
        error: function () {
            Swal.fire("Error!", "Something went wrong.", "error");
        }
    });
});

// Load customers on page load
$(document).ready(function () {
    loadCustomers();
});
