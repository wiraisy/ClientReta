$(".deleteAlert").on("click", function(e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
        title: "Are you sure you want to delete?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Delete!",
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    });
});