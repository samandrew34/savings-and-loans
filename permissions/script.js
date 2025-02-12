$(document).ready(function () {
    function loadUsers(page = 1) {
        $.ajax({
            url: "fetch_users.php",
            method: "GET",
            dataType: "json",
            success: function (data) {
                let perPage = 7;
                let start = (page - 1) * perPage;
                let end = start + perPage;
                let users = data.slice(start, end);
                let tableBody = $("#usersTable tbody");
                tableBody.empty();

                let userIdsDisplayed = new Set(); // Track displayed user IDs

                users.forEach((user) => {
                    if (!userIdsDisplayed.has(user.userid)) { // Prevent duplicates
                        userIdsDisplayed.add(user.userid);

                        let userImage = user.userimage ? `../asset/users/${user.userimage}` : "../asset/users/user.jpg";

                        let buttons = `
                            ${user.show_buttons ? `
                                <button type="button" class="btn btn-sm btn-square btn-neutral text-success-hover">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-square btn-neutral text-info-hover view-btn" data-userid="${user.userid}" data-role="${user.role}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-square btn-neutral text-primary-hover">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button type="button" onclick="showSweetAlert()" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                    <i class="bi bi-trash"></i>
                                </button>
                            ` : ""}
                        `;

                        let row = `
                            <tr>
                                <td>
                                    <img src="${userImage}" class="avatar avatar-sm rounded-circle me-2" alt="User">
                                    <a class="text-heading font-semibold" href="#">${user.fullname}</a>
                                </td>
                                <td>${user.workid}</td>
                                <td>${user.userid}</td>
                                <td>${user.role}</td>
                                 <td>${user.status}</td>
                                <td class="text-end">${buttons}</td>
                            </tr>
                        `;
                        tableBody.append(row);
                    }
                });

                setupPagination(data.length, perPage, page);
            },
            error: function (xhr, status, error) {
                console.error("Failed to fetch data:", error);
            },
        });
    }

    loadUsers();
});
