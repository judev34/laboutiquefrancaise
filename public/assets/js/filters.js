window.onload = () => {
    const FiltersForm = document.querySelector("form");
    // on boucle sur les inputs
    document.querySelectorAll("#categories input").forEach(input => {
        // je met un eventlistener
        input.addEventListener("change", () => {
            // ici on intercepte les clics
            // on récupère les données du formulaire
            // console.log("clic");
            console.log(FiltersForm);
            const Form = new FormData(FiltersForm);

            // on fabrique la "queryString"
            const Params = new URLSearchParams();

            Form.forEach((value, key) => {
                // console.log(key, value);
                Params.append(key, value);
                console.log(Params.toString());
            })

            //on récupère l'URL active
            const Url = new URL(window.location.href);
            console.log(Url);
            // / on lance la requete AJAX 
            fetch(Url.pathname + "?" + Params.toString() + "&ajax=1", {
                headers: {
                    "x-Requested-With": "XMLHttpRequest"
                }
            }).then(response => {
                console.log(response);
            }).catch(e => alert(e));

        })
    })
}