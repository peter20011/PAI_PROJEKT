const search = document.querySelector('input[placeholder="search band"]');
const bandContainer = document.querySelector(".band-display");

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (bands) {
            bandContainer.innerHTML = "";
            loadBands(bands)
        });
    }
});

function loadBands(bands) {
    bands.forEach(band => {
        createBand(band);
    });
}

function createBand(band) {
    const template = document.querySelector("#band-template");
    const clone = template.content.cloneNode(true);
    const image = clone.querySelector("img");
    image.src = `/public/img/band.svg`;
    const title = clone.querySelector(".name");
    title.innerHTML = band.username;


    bandContainer.appendChild(clone);
}
