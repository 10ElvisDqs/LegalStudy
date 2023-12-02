export class search
{
    constructor(myurlp,mysearchp, ul_add_lip){
        this.url=myurlp;
        this.mysearch=mysearchp;
        this.ul_add_li=ul_add_lip;
        this.idli="mylist";
        this.pcantidad=document.querySelector("#pcantidad");
    }
    InputSearch(){
        this.mysearch.addEventListener("input",(e)=>{
            e.preventDefault();
            try {
//                let token = document.querySelector('meta[name="csrf-token"]').getAttribute("contet");
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

                let minimo_letras=0;
                let valor= this.mysearch.value;
                if (valor.length > minimo_letras) {
                    let datasearch=new FormData();
                    datasearch.append("valor",valor);
                    fetch(this.url,{
                        headers:{
                            "X-CSRF-TOKEN":token,
                        },
                        method:"post",
                        body:datasearch
                    })
                    .then((data)=>data.json())
                    .then((data)=>{
                        console.log(data);
                        this.Showlist(data,valor);
                    })
                    .catch(function (error){
                        console.log("Error: ",error);
                    });
                } else {
                    this.ul_add_li.style.display="";
                }
            } catch (error) {
                console.log(error);
            }
        })
    }

    Showlist(data,valor){
        this.ul_add_li.style.display="block";
        console.log("Ingreso al Showlist", data);

            if(data.result != ""){
                let arrayp=data.result;
                this.ul_add_li.innerHTML="";
                let n=0;
                console.log(n);

                this.Show_list_each_data(arrayp,valor,n);
                let adclasli=document.getElementById('1'+this.idli);
                adclasli.classList.add('selected');
            }else{
                this.ul_add_li.innerHTML="";
                this.ul_add_li.innerHTML+=`
                <li class="list-group-item" style="">
                <div class="d-flex flex-row" style="">
                <span class="badge bg-danger rounded-pill"><br>No se Encontro el nombre</span>
                </div>
                </li>
                `;
            }

    }

    Show_list_each_data(arrayp,valor,n){
        let input_user = document.getElementById('user');
        let input_dni  = document.getElementById('dni');
        input_user.value="";
        input_dni.value="";

        for (let item of arrayp) {
            n++;
            let nombre=item.nombre || '';
            this.ul_add_li.innerHTML+=`
            <li id="${n+this.idli}" value="${item.nombre } " class="list-group-item" style="">
            <div class="d-flex flex-row" style="">
            <span class="bg-success rounded-pill">
               <strong>${nombre.substr(0,valor.length)}</strong>
                ${nombre.substr(valor.length)}
                ${item.apellido}
            </span>

            </div>
            </li>
            `;

            input_user.value=item.nombre+" "+item.apellido;
            input_dni.value=item.dni;
        }
    }

}
