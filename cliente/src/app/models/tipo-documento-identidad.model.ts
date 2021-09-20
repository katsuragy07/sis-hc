export class TipoDocumentoIdentidad{
    id: string;
    descripcion: string;
    observacion: string;
    nro_caracter: string;
    tipo_documento_his: string;
    estado: string;
    es_reniec: string;
    es_reclamo: string;
    constructor(){
        this.id = "";
        this.descripcion = "";
        this.observacion = "";
        this.nro_caracter = "";
        this.tipo_documento_his = "";
        this.estado = "";
        this.es_reniec = "";
        this.es_reclamo = "";
    }
}