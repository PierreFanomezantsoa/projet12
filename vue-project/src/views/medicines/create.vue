<template>
    <div class="cotainer" style="position: absolute; left: 450px; height: 580px; width: 647px;">
    <div class="card">
        <div class="card-header">
            <h5 style="text-align: center;">Ajout Medicine</h5>
        </div>
        <div class="card-header">
            <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
                    <li class="mb-0 ms-3" v-for="(error, index) in this.errorList" :key="index">
                        {{ error[0] }}
                    </li>
                </ul>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="">Nom </label>
                <input type="text" class="from-control" v-model="model.medicine.nom"  style="width: 390px; position: absolute; right: 12px;"/>
            </div><br>
            <div class="mb-3">
                <label for="">Nombre des jours</label>
                <input type="number" class="from-control" pattern="[0-9]{20}" v-model="model.medicine.jour" style="width: 390px; position: absolute; right: 12px;"/>
            </div><br>
            <div class="mb-3">
                <label for="">Taux journalier</label>
                <input type="number" class="from-control" pattern="[0-9]{20}" v-model="model.medicine.taux"  style="width: 390px; position: absolute; right: 12px;" required/>
            </div><br>
            <div class="mb-3">
                <RouterLink to="/medicines">
                    <button type="button" @click="ajouteMedicine" class="btn btn-primary" style="width: 210px;">ajouter</button>
                </RouterLink>
               
            </div>
        </div>
    </div>
    </div>
    
    </template>
    <script>
import axios from 'axios'
import View from '../medicines/View.vue'
        export default{
            name: 'createMed',
            data(){
                return{
                    errorList:'',
                    model: {
                    medicine: {
                        numed: '',
                        nom: '',
                        jour:'',
                        taux: ''

                    }
                }
                }
               
            },
            methods:{
                ajouteMedicine(){
                   
                    axios.post('http://127.0.0.1:8000/api/medicines',this.model.medicine)
                    .then(res=>{
                        console.log(res.data)
                        alert(res.data.message)
                        this.model.medicine= {
                        numed: '',
                        nom: '',
                        jour:'',
                        taux: '',
                        

                    }  
                    this.errorList='';
                    }).catch(function(error){

                    if (error.response) {

                     if(error.response.status == 422){

                      mythis.errorList = error.response.data.error;
                         }
                    if(error.response.status == 404){

                     alert(error.response.data.message);
                         }
                      //console.log(error.response.data);
                      //console.log(error.response.status);
                      //console.log(error.response.headers);
                   } else if (error.request) {
                  console.log(error.request);
                  } else {
                  console.log('Error', error.message);
           }

            })
                }
            },
        }

    </script>