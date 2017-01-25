
var persona = "Elian";
var persona = {
    nombre: "Israel",
    apellido: "Martínez",
    imprimirNombre: function () {
       console.log(this.nombre + " " + this.apellido);
    },
    direccion: {
        pais: "México",
        obtenerPais: function () {
            var self = this;
            var nuevaDireccion = function () {
                console.log(self);
                console.log( "su país es " + self.pais );
            }
            nuevaDireccion();
        }
    }
};

persona.imprimirNombre();
persona.direccion.obtenerPais();

// palabra reservada NEW como objeto
function Persona () {
    this.nombre = "Israel";
    this.apellido = "Martinez";
    this.edad = 34;

}
var israel = new Persona();

console.log(israel);

// palabra reservada NEW como parametro
function Persona2(nombre,apellido){
    this.nombre = nombre;
    this.apellido = apellido;
    this.edad = 34;

    this.imprimirPersona2 = function() {
        return this.nombre + " " + this.apellido + "("+ this.edad +")";
    }

}
var elian = new Persona2("Elian","Martinez");
console.log( elian.imprimirPersona2() );