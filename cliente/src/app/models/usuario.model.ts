
export class Usuario{
    id: string;
    privilegios: string;
    accesos: string;
    email: string;
    pass: string;
    nombre: string;
    apellido: string;
    constructor(){
        this.id = "";
        this.privilegios = "";
        this.accesos = "";
        this.email = "";
        this.pass = "";
        this.nombre = "";
        this.apellido = "";
    }
}