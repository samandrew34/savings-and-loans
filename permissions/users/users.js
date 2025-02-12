





$(document).ready(function () {
    function loadUsers(page = 1) {
        $.ajax({
            url: "fetch_users.php",
            method: "GET",
            dataType: "json",
            success: function (data) {
                let perPage = 10;
                let start = (page - 1) * perPage;
                let end = start + perPage;
                let users = data.slice(start, end);
                let tableBody = $("#usersTable tbody");
                tableBody.empty();

                users.forEach((user) => {
                    let userImage = user.userimage ? `../asset/user/${user.userimage}` : "../asset/users/user.jpg";
                    let statusBadge = `<span class="badge ${user.status === 'active' ? 'bg-success' : 'bg-danger'}">${user.status}</span>`;

                    let row = `
                        <tr>
                            <td>
                                <img src="${userImage}" class="avatar avatar-sm rounded-circle me-2" alt="User">
                                <a class="text-heading font-semibold" href="#">${user.fullname}</a>
                            </td>
                            <td>${user.workid}</td>
                            <td>${user.userid}</td>
                            <td>${user.role}</td>
                            <td>${statusBadge}</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-square btn-neutral text-success-hover"><i class="bi bi-plus-circle"></i></button>
                                <button type="button" class="btn btn-sm btn-square btn-neutral text-info-hover"><i class="bi bi-eye"></i></button>
                                <button type="button" class="btn btn-sm btn-square btn-neutral text-primary-hover"><i class="bi bi-pencil-square"></i></button>
                                <button type="button" onclick="showSweetAlert()" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    `;
                    tableBody.append(row);
                });

                setupPagination(data.length, perPage, page);
            },
            error: function () {
                console.error("Failed to fetch data.");
            },
        });
    }

    function setupPagination(totalItems, perPage, currentPage) {
        let totalPages = Math.ceil(totalItems / perPage);
        let pagination = $(".pagination");
        pagination.empty();

        let prevClass = currentPage === 1 ? "disabled" : "";
        pagination.append(`<li class="page-item ${prevClass}"><a class="page-link" href="#" data-page="${currentPage - 1}">Previous</a></li>`);

        for (let i = 1; i <= totalPages; i++) {
            let activeClass = i === currentPage ? "bg-info text-white" : "";
            pagination.append(`<li class="page-item"><a class="page-link ${activeClass}" href="#" data-page="${i}">${i}</a></li>`);
        }

        let nextClass = currentPage === totalPages ? "disabled" : "";
        pagination.append(`<li class="page-item ${nextClass}"><a class="page-link" href="#" data-page="${currentPage + 1}">Next</a></li>`);
    }

    $(document).on("click", ".pagination .page-link", function (e) {
        e.preventDefault();
        let page = parseInt($(this).data("page"));
        if (!isNaN(page)) {
            loadUsers(page);
        }
    });

    loadUsers();
});
