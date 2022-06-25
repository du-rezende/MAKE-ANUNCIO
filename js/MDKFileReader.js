class MDKFileReader extends FileReader {
  _obj = {
    nome:"",
    id:"",
    file:null
  }
  
  get obj(){

    return this._obj;
  }

  set obj(o){
    this._obj = o;
  }
  
  }