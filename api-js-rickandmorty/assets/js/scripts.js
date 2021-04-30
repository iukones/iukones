    'use strict'
    // {}//objeto
    // []//arreglo Array

    const populate = document.getElementById('populate');
    // console.log(populate);

    // let holaApi = new XMLHttpRequest();

    // holaApi.addEventListener("load", getData);
    // holaApi.open("GET", "https://rickandmortyapi.com/api/character/");
    // holaApi.send();

    // function getData() {
    //     let data = JSON.parse(this.responseText);
    //     // console.log(data);
    //     // console.log(this.responseText);
    //     let characterInfo = data.results.map(function (character) {
    //         return `
    //         <div class="name">${character.name}</div>
    //         <div class="image"><img src="${character.image}"/></div>
    //         `
    //     })
    //     populate.innerHTML = characterInfo;
    // }

    function getData() {
        fetch('https://rickandmortyapi.com/api/character/')
            .then((response) => response.json())
            .then(function(data) {
                let characterInfo = data.results.map(function (character) {
                    return `
                    <div class="w3-row-padding ">
                        <div class="w3-col m4 w3-margin-bottom">
                            <div class="w3-light-grey">
                                <img src="${character.image}" alt="" style="width:100%">
                                <div class="w3-container">
                                    <h3>Nombre: ${character.name}</h3>
                                    <p class="w3-opacity">Especie: ${character.species}</p>
                                    <p>Sexo: ${character.gender}</p>
                                    <p><strong>${character.status}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>`
                    }).join('');

                    populate.innerHTML = characterInfo;
                    console.log(data);
            })
            .catch(function(error) {
                console.log(error);
            })
    }

    // npm install axios --save
    // import axios from 'axios'

    // axios.get('https://rickandmortyapi.com/api/character/')
    //     .then(function(data) {
    //         console.log(data);
    //     })
    //     .catch(function (error) {
    //         console.log(error);
    //     })

    getData();

