function filterFiles(type, button) {

    document.querySelectorAll(".filter-btn")
        .forEach(btn => btn.classList.remove("active"));

    button.classList.add("active");

    document.querySelectorAll(".file-card")
        .forEach(card => {

            if (type === "all") {

                card.style.display = "";

                return;
            }

            card.style.display =
                card.dataset.type === type
                    ? ""
                    : "none";

        });

}

const search = document.getElementById("fileSearch");

if (search) {

    search.addEventListener("keyup", function () {

        let value = this.value.toLowerCase();

        document.querySelectorAll(".file-card")
            .forEach(card => {

                card.style.display =
                    card.dataset.name.includes(value)
                        ? ""
                        : "none";

            });

    });

}