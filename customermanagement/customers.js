// Function to fetch data from fetch_customers.php
function loadCustomers() {
    $.ajax({
        url: "fetch_customers.php",
        method: "GET",
        dataType: "json",
        success: function (customerData) {
            if (customerData.error) {
                console.error(customerData.error);
                return;
            }

            // Fetch button permissions from fetch_customer_buttons.php
            $.ajax({
                url: "fetch_customer_buttons.php",
                method: "GET",
                dataType: "json",
                success: function (buttonPermissions) {
                    let tableBody = $("#searchableTable tbody");
                    tableBody.empty();

                    customerData.forEach((customer) => {
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
                                    <!-- Add Button -->
                                    ${buttonPermissions.add !== "hidden" ? `
                                        <button type="button" class="btn btn-sm btn-square btn-neutral text-success-hover"
                                            ${buttonPermissions.add === "disabled" ? "disabled" : ""}>
                                            <i class="bi bi-plus-circle"></i>
                                        </button>` : ""
                                    }

                                    <!-- Edit Button -->
                                    ${buttonPermissions.edit !== "hidden" ? `
                                        <button onclick="openEditModal(${customer.customerid})" class="btn btn-sm btn-primary"
                                            ${buttonPermissions.edit === "disabled" ? "disabled" : ""}>
                                            <i class="bi bi-pencil-square"></i> 
                                        </button>` : ""
                                    }

                                    <!-- View Button -->
                                    ${buttonPermissions.show !== "hidden" ? `
                                        <button type="button" onclick="window.location.href='edit_user.php?customerid=${customer.customerid}'"
                                            class="btn btn-sm btn-square btn-neutral text-info-hover"
                                            ${buttonPermissions.show === "disabled" ? "disabled" : ""}>
                                            <i class="bi bi-eye"></i>
                                        </button>` : ""
                                    }

                                    <!-- Delete Button -->
                                    ${buttonPermissions.delete !== "hidden" ? `
                                        <button type="button" onclick="deleteCustomer(${customer.customerid})"
                                            class="btn btn-sm btn-square btn-neutral text-danger-hover"
                                            ${buttonPermissions.delete === "disabled" ? "disabled" : ""}>
                                            <i class="bi bi-trash"></i>
                                        </button>` : ""
                                    }
                                </td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Failed to fetch button permissions:", error);
                },
            });
        },
        error: function (xhr, status, error) {
            console.error("Failed to fetch customer data:", error);
        },
    });
}

// Load customers on page load
$(document).ready(function () {
    loadCustomers();
});
