class Pagination {
    constructor(element, options = {}) {
        this.element = element;
        this.options = Object.assign({}, {
            showPerPage : 1,
            currentPage: 0
        }, options);

        // Création d'un array avec les enfants de this.element
        this.children = [].slice.call(element.children);
        // Recuperation du nombre d'items dans children, ici 4
        this.items = this.children.length;

        this.setStyle(0, this.options.showPerPage);
        this.createPagination();

        let buttonPagination = [].slice.call(document.querySelectorAll(".page-link"));
        buttonPagination.map((child) => {
            child.addEventListener("click", () => {
                this.goToPage(child.classList[1]);
            })
        });
    }

    numberOfPages() {
        return( Math.ceil(this.items / this.options.showPerPage));
    }

    setStyle(first, last) {
        this.children.forEach((child) => {
            child.style.display = "none";
        });
        this.children.slice(first, last).forEach((child) => {
            child.style.display = "flex";
        })
    }

    createPagination() {
        let ul = document.createElement("ul");
        ul.setAttribute("class", "pagination");
        ul.classList.add("justify-content-center");
        let i = -1;
        while(this.numberOfPages() > ++i){
            let li = document.createElement("li");
            li.setAttribute("class", "page-item");
            if (!i) {
                li.classList.add("active");
            }
            let link = document.createElement("a");
            link.setAttribute("class", "page-link");
            link.classList.add("" + i + "");
            link.innerHTML = i + 1;

            li.setAttribute("id", "id" + i);
            li.appendChild(link);
            ul.appendChild(li);
        }

        // Container pour la pagination
        document.querySelector("#container_navigation").appendChild(ul);
    }


    goToPage(page_num) {
        this.options.currentPage = page_num;
        let start = this.options.currentPage * this.options.showPerPage;
        let end = start + this.options.showPerPage;
        this.setStyle(start, end);
        document.querySelector("li.active").classList.remove("active");
        document.getElementById("id" + page_num).classList.add("active");
    }

}

document.addEventListener("DOMContentLoaded", function() {

    if (document.querySelector("#js_container_trick") != null) {
        new Pagination(document.querySelector("#js_container_trick"), {
            showPerPage : 8,
            currentPage: 0,
        });
    }
    if (document.querySelector("#js_container_comment") != null) {
        new Pagination(document.querySelector("#js_container_comment"), {
            showPerPage : 5,
            currentPage: 0,
        });
    }

});