<template>
    <div class="cotainer" style="position: absolute; left: 450px; height: 580px; width: 647px;">
    <div class="card">
        <div class="card-header">
            <h5 style="text-align: center;">Modification Medicine</h5>
        </div>
        <div class="card-header">
            <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length >0">
                <li class="mb-0 mb-3" v-for="(error, index) in this.errorList" :key="index">
                    {{ error[0] }}
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="">Nom </label>
                <input type="text" class="from-control" v-model="medicine.nom"  style="width: 390px; position: absolute; right: 12px;"/>
            </div><br>
            <div class="mb-3">
                <label for="">Nombre des jours</label>
                <input type="number" class="from-control" v-model="medicine.jour" style="width: 390px; position: absolute; right: 12px;"/>
            </div><br>
            <div class="mb-3">
                <label for="">Taux journalier</label>
                <input type="number" class="from-control" v-model="medicine.taux"  style="width: 390px; position: absolute; right: 12px;"/>
            </div><br>
            <div class="mb-3">
               <button type="button" @click="ModifMedicine" class="btn btn-primary" style="width: 210px;">Save</button>
            </div>
        </div>
    </div>
    </div>
    
    </template>
    <script>
import axios from 'axios'

        export default{
            name: 'editMed',
            data(){
                return{
                    me:'',
                    errorList:'',
                    medicine: {
                        nom: '',
                        jour:'',
                        taux: ''

                    }
                }
               
            },
            mounted(){
                this.me=this.$route.params.id;
                this.getmedicinesData(this.$route.params.id);
            },
            methods:{
                getmedicinesData(me){
                    axios.get(`http://127.0.0.1:8000/api/medicines/${me}/edit`).then(res=>{
                        console.log(res.data.medicine);
                        this.medicine=res.data.medicine;
                        $('#modal').modal('show');
                    })
                    .catch(function (error){
                        if(error.response){
                            if(error.response.status ==404){
                           alert(error.response.data.message);
                        }
                    }
                    });
                },
                ModifMedicine(){
                    var mythis=this;
                    axios.put(`http://127.0.0.1:8000/api/medicines/${this.me}/edit`,this.medicine)
                    .then(res=>{
                        console.log(res.data)
                        alert(res.data.message)
                        this.errorList='Bien modifie'; 
                    })
                    .catch(function(error){
                        if(error.response){
                            if(error.response.status == 422){
                                mythis.errorList=error.response.data.errors;
                            }
                            if(error.response.status ==404){
                                alert(error.response.data.message);
                            }
                            else if(error.request){
                                console.log(error.request);
                            }
                            else{
                                console.log('Error', error.message);
                            }
                        }
                    })
                }
            },
        }

    </script>