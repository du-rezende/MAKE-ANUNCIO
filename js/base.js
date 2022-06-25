$("#makeCSV").click(function() {
$("#do_csv").val("true")
$("#form1").submit()

})


document.querySelectorAll('[data-selected]').forEach(e => {
    e.value = e.dataset.selected
 });

$( "#add_vars" ).click(function() {

$("#my_vars").append(`
<div class="row">

  <div class="col-5">

  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Nome</label>
    <input type="text" class="form-control" name="variacao_nome[]" >
  </div>
  </div>
  <div class="col-5">
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Cor</label>
    
    <select class="form-control form-select" name="variacao_cor[]" >
    <option value=""></option>
    <option value="Amarelo">Amarelo</option>
<option value="Azul">Azul</option>
<option value="Bege">Bege</option>
<option value="Branco">Branco</option>
<option value="Bronze">Bronze</option>
<option value="Cinza">Cinza</option>
<option value="Cobre">Cobre</option>
<option value="Colorido">Colorido</option>
<option value="Creme">Creme</option>
<option value="Cromado">Cromado</option>
<option value="Laranja">Laranja</option>
<option value="Marrom">Marrom</option>
<option value="Metálico">Metálico</option>
<option value="Natural">Natural</option>
<option value="Ouro">Ouro</option>
<option value="Prata">Prata</option>
<option value="Preto">Preto</option>
<option value="Rosa">Rosa</option>
<option value="Roxo">Roxo</option>
<option value="Transparente">Transparente</option>
<option value="Verde">Verde</option>
<option value="Vermelho">Vermelho</option>
</select>
  </div>
  </div>
  <div class="col-2">
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">.</label>
    <button type="button"  class="form-control btn btn-sucessbtn btn-danger del_vars">DEL</button>
  </div>
  </div>
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">IMG</label>
  <input type="text" class="form-control" name="variacao_img[]" value="">
  </div>
    </div>

`)
})

$( ".del_vars" ).click(function(ev) {

    $(ev.target).parent().parent().parent().remove()

})


/////upload ajax


$("#form_upload").on('submit',(function(e) {
    e.preventDefault();
    m_data = new FormData(this)

     /*
    $( "#imgC" ).children().each(function(  i, ev  ) {

      
        x = $(this).children("img")
        console.log(x.file)
        d1 = ev.getAttribute("datafile")
        console.log(JSON.stringify(d1))
        d = d1.split("base64,")[1]
        
        console.log(d)
        var blob = new Blob(d1)
        
        m_data.append('fileToUpload', d1, 'chris1.jpg'); 
            })
            
*/

   /*  m_data.append('username', 'Chris');
    console.log(m_data.getAll("fileToUpload"))
    d = m_data.getAll("fileToUpload")
    d[0]["c"]="jkl"
    m_data.set('fileToUpload', d[0], 'chris1.jpg');
    console.log(m_data.getAll("userpic"))
    for(const pair of m_data.entries()) {
        console.log(JSON.stringify(pair))
        //console.log(`${pair[0]}, ${pair[1].toString()}`);
      } */
      console.log(m_data.getAll("fileToUpload[]"))
      d = m_data.getAll("fileToUpload")
     $.ajax({
           url: "upload.php",
     type: "POST",
     data:  m_data,
     contentType: false,
           cache: false,
     processData:false,
    
     success: function(data)
        {
   

$("#ret").html(data)
alert("ok upload")

        },
         
      });


   }));

/////upload ajax end



function del_click(ev){
    console.log(ev.target)
    $(ev.target).parent().parent().remove()


}





$( ".bt_get" ).click(function(e) {

my_base = e.target.getAttribute("base")
mi = e.target.getAttribute("base_id")

    $("#retV"+my_base).html("")

    my_a =[]
    $( "#imgV"+my_base ).children().each(function(  i, ev  ) {

console.log(i, ev)
my_i = ev.getAttribute("id_base")
my_a.push($("#file_dir_base").val()+$("#file_name_base").val()+"_"+my_i+".jpg")


    })

    s= my_a.join("|")
$("#retV"+my_base).append(s)

if (my_base =="-PAI"){

  $("#img").val(s)
}else{
  $('input[name="variacao_img[]"]').eq(mi).val(s)

}


  });



  var contador_total = 0
  var contador_indice = 0

function fim(){

if(contador_total == contador_indice){
alert("faz up q o nego ta esquecendo!")
$("#form_upload").submit()

}

}


const fileI = $("#inputI")[0];
fileI.onchange = () => {

  contador_total = fileI.files.length
  contador_indice = 0
for(i=0; i< fileI.files.length; i++){

   // console.log(fileI.files[i])
    renderImg(fileI.files[i],i)
}





}


function renderImg(f,fid){
//cria a img



var reader = new MDKFileReader();
reader.onloadend = function () {
    //img_div.src = reader.result;

  //  console.log(reader.result)

    t_card=`
    <div id="imgUP"  class="card m-2" style="width: 150px;" id_base="`+reader.obj.id+`" id_drag="`+reader.obj.nome+`" draggable="true" ondragstart="drag(event)" >
  <img  src="`+reader.result+`" class="card-img-top" id_drag="`+reader.obj.nome+`" draggable="true" ondragstart="drag(event)">
  <button type="button" class="btn btn-danger btn-sm class-del" id_drag="`+reader.obj.nome+`"  onClick="del_click(event)">DEL</button>
  <div class="card-body" id_drag="`+reader.obj.nome+`" ondragover="return true">


  </div>
</div>
    `

    img_div = $($.parseHTML(t_card));
    //img_div = $($.parseHTML('<img id="imgUP'+reader.obj.id+'" src="'+reader.result+'" class="img-thumbnail m-2" alt="..." width="100px" draggable="true" ondragstart="drag(event)" onClick="img_click(`'+reader.obj+'`)" >'));
$("#imgC").append(img_div)
contador_indice ++
fim()
//mydrag()


    
  }
  reader.obj = {nome:f.name,id:fid}
  reader.readAsDataURL(f);
 

}






function allowDrop(ev) {
    ev.stopPropagation();
    ev.preventDefault();
  
  }
  
  function drag(ev) {

    console.log(ev.target.getAttribute("id_drag"))
    
    ev.dataTransfer.setData("text", ev.target.getAttribute("id_drag"));


  }
  
  function drop(ev) {
    ev.preventDefault();
    //var data = ev.dataTransfer.getData("text");
    //ev.target.appendChild(document.getElementById(data));

    var idx = ev.dataTransfer.getData("text");
    var id = $("#imgUP[id_drag='"+idx+"']")[0]
    var nodeCopy = id.cloneNode(true);
    nodeCopy.id = "newId";
    ev.target.appendChild(nodeCopy);


  }
/* 
      const dragenter = (e) => {
        e.stopPropagation();
        e.preventDefault();
      }
      const dragover = (e) => {
        e.stopPropagation();
        e.preventDefault();
      }
      const drop = (e) => {
        e.stopPropagation();
        e.preventDefault();
        const dt = e.dataTransfer;
        const files = [...dt.files];
        console.log(files);
      }

      let dropbox1 = document.getElementById("dropbox1");
      dropbox1.addEventListener("dragenter", dragenter, false);
      dropbox1.addEventListener("dragover", dragover, false);
      dropbox1.addEventListener("drop", drop, false);


      let dropbox2 = document.getElementById("dropbox2");
      dropbox2.addEventListener("dragenter", dragenter, false);
      dropbox2.addEventListener("dragover", dragover, false);
      dropbox2.addEventListener("drop", drop, false); */